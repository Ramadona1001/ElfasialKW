<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\SoicalMedia;
use App\User;
use App\Customer;
use App\Catalog;
use App\Department;
use App\CatalogItem;
use App\FromChoice;
use App\Inventory;
use App\Order;
use App\Task;
use App\ContactUs;
use App\Category;
use App\Cart;
use App\Feedback;
use App\Order_Review;
use App\Buffet;
use Session;
use DB;
use Hash;
use Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\FromChoiceItems;
use Nexmo\Laravel\Facade\Nexmo;
use App\Package;
use App\PackageItem;

class FrontendController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth')->except(
    //         'changeOrderQuantity',
    //         'register',
    //         'index',
    //         'aboutus',
    //         'services',
    //         'single_services',
    //         'portfolio',
    //         'contactus',
    //         'store_contactus',
    //         'addToCart',
    //         'viewCart',
    //         'viewCart',
    //         'changeOrderQuantity',
    //         'sendFeedback',
    //         'buffet_services',
    //         'buffet_services_details',
    //         'buffet_services_choice',
    //         'single_services_details',
    //         'termsConditions'
    //     );
    // }


    public function changeOrderQuantity($order_date){ //Change Orders Quantity After time is expired
        date_default_timezone_set("Africa/Cairo");
        $date = new DateTime(date('Y-m-d H:i:s'));
        $interval = $date->diff($order_date);
        $days = $interval->format('%a');
        $hours = $interval->format('%h');
        $mins = $interval->format('%i');
        
        if($days == 0){
            return true;
        }else{
            return false;
        }
    }

    public function myAccount(){
        $user_id = Auth::user()->id;
        $customer = Customer::where('user_id',$user_id)->get()->first();
        return view('frontend.pages.account',compact('user_id','customer'));
    }

    public function myAccountPost(Request $request){
        $user_id = Auth::user()->id;
        $user = User::findOrfail($user_id);
        $customer = Customer::where('user_id',$user_id)->get()->first();
        
        if($request->password != null){
            

            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->password =  Hash::make($request->password);

            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->password =  Hash::make($request->password);

            $user->save();
            $customer->save();
        }else{
            

            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->save();

            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->password =  Hash::make($request->password);

            $user->save();
        }

        return back()->with('success','');

    }

    public function sendFeedback(Request $request){
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'comment' => 'required|min:2'
        ]);

        $name = $request->name;
        $email = $request->email;
        $comment = $request->comment;

        $feedback = new Feedback();
        $feedback->name = $name;
        $feedback->email = $email;
        $feedback->comment = $comment;

        $feedback->save();

        return back()->with('success','');
    }

    public function myorders(){
        $user_id = Auth::user()->id;
        if(Customer::where('user_id',$user_id)->count() > 0){
            $customer = Customer::where('user_id',$user_id)->get()->first();
            $orders = Order::where('customer_id',$customer->id)->paginate(9);
            return view('frontend.pages.my_orders',compact('user_id','customer','orders'));
        }
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255|min:2',
            'mobile' => 'required|max:255|min:2',
            'email' => 'required|unique:customers',
            'password' => 'required|confirmed|min:6|max:20',
        ]);
        
        
        $user = new User();
        $user->mobile = $request->mobile;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $customers = new Customer();

        $customers->name = $request->name;
        $customers->email = $request->email;
        $customers->password = Hash::make($request->password);
        $customers->user_id = $user->id;
        $customers->mobile = $request->mobile;
        $customers->save();
        
        

        if ($request->hasFile('file_path')) {
            for ($i=0; $i <count($request->file_name) ; $i++) { 
                $customersfiles = new CustomerFile();
                $customersfiles->file_name = $request->file_name[$i];

                $image = $request->file('file_path')[$i];
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/customers/files');
                $image->move($destinationPath, $name);
                $customersfiles->file_path = $name;
                $customersfiles->customer_id = $customers->id;
                $customersfiles->save();
            }
            
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('frontend_index');
        }
    }
    
    public function index(){

        $orders = Order::where('orders.status','new')->get();
        
        
        // foreach ($orders as $order) {
        //     $order_date = new DateTime($order->order_day.' '.$order->order_to, new DateTimeZone('Africa/Cairo'));
          
        //     if ($order->status == 'new') {
                
        //         if ($this->changeOrderQuantity($order_date)) {
        //             $updateOrder = Order::findOrfail($order->id);
        //             $updateOrder->status = 'finished';
        //             $updateOrder->save();
                    
        //             $order_data = json_decode($order->order_data,true);
        //             $count = count($order_data) / 4;
        //             for ($i=0; $i < $count; $i++) {
        //                 $id = 'id_'.$i;
        //                 $quantity = 'quantity_'.$i;
        //                 $item = CatalogItem::findOrfail($order_data[$id]);
        //                 $inventory = Inventory::findOrfail($item->inventory_id);
        //                 $inventory->quantity = $inventory->quantity + $order_data[$quantity];
        //                 $inventory->save();
        //             }
        //         }
        //     }
        // }


        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->limit(3)->get();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id')->get();
        $customers_count = Customer::count();
        $orders_count = Order::count();
        $reviews_count = Feedback::count();
        $catalogs_count = Catalog::count();
        return view('frontend.index',compact('categories','catalogs','customers_count','orders_count','reviews_count','catalogs_count'));
    }
    
    public function aboutus(){
        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        return view('frontend.pages.aboutus',compact('categories'));
    }
    
    public function services(){
        $lang = \Lang::getLocale();
        $packagesCategory = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->groupBy('category_id')->get();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id')->get();
        
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        
        $buffetsCategory = Buffet::select('no_members','id','buffets_image',$lang.'_desc as desc','categories_id')->groupBy('categories_id')->get();
       
        return view('frontend.pages.services',compact('category','catalogs','buffetsCategory','packagesCategory'));
    }

    public function fromchoice($id)
    {
        $lang = \Lang::getLocale();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id')->get();
        
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        
        $buffetsCategory = Buffet::select('no_members','id','buffets_image',$lang.'_desc as desc','categories_id')->groupBy('categories_id')->get();

        return view('frontend.pages.fromchoice',compact('category','catalogs','buffetsCategory'));
    }

    public function packages()
    {
        
        $lang = \Lang::getLocale();
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        $packagesCategory = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->get();
        

        return view('frontend.pages.package',compact('category','packagesCategory'));
    }

    public function packagesDetails($id)
    {
        $lang = \Lang::getLocale();
        $package = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->where('id',$id)->get()->first();
        $packagesItems = PackageItem::where('package_id',$id)->get();
        return view('frontend.pages.package_single',compact('package','packagesItems'));
    }

    public function buffet_services($id){
        $lang = \Lang::getLocale();
        $category_id = $id;
        $buffets = Buffet::select($lang.'_name as name','no_members','id','buffets_image',$lang.'_desc as desc','categories_id','price')->where('categories_id',$id)->get();
        return view('frontend.pages.buffet_services',compact('buffets','category_id'));
    }

    public function buffet_services_choice($id){
        $lang = \Lang::getLocale();
        $fromchoices = FromChoice::select($lang.'_name as name','id','fromchoice_image',$lang.'_desc as desc','categories_id')->where('categories_id',$id)->get();
        return view('frontend.pages.fromchoices_services',compact('fromchoices'));
    }

    public function buffet_services_choice_details($id){
        $lang = \Lang::getLocale();
        $fromchoicesItems = FromChoiceItems::select($lang.'_name as name','id',$lang.'_desc as desc','from_choices_id')->where('from_choices_id',$id)->get();
        $fromchoices = FromChoice::select($lang.'_name as name','id','fromchoice_image',$lang.'_desc as desc','categories_id')->where('id',$id)->get()->first();
        // $items = FromChoiceItems::select('id',$lang.'_desc as desc','from_choices_id')->where('from_choices_id',$id)->get();
        // dd($fromchoicesItems);
        return view('frontend.pages.buffet_choice_single',compact('fromchoices','fromchoicesItems'));
    }

    public function buffet_services_choice_items($id){
        $lang = \Lang::getLocale();
        $items = FromChoiceItems::select('id',$lang.'_desc as desc',$lang.'_name as name','inventory_id','from_choices_id')->where('id',$id)->get()->first();
        return view('frontend.pages.buffet_choice_items',compact('items'));
    }
    
    public function buffet_services_details($id){
        $lang = \Lang::getLocale();
        $buffet = Buffet::select($lang.'_name as name','no_members','id','buffets_image',$lang.'_desc as desc','categories_id','price')->where('id',$id)->get()->first();
        return view('frontend.pages.buffet_services_single',compact('buffet'));
    }

    public function single_services($id){
        $lang = \Lang::getLocale();
        $customers = Customer::all();
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get()->first();
        $catalog = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id','price')->where('categories_id',$id)->get();
    //    dd($catalog);
        return view('frontend.pages.single_services',compact('category','catalog','customers'));
    }
    
    public function single_services_details($id){
        $lang = \Lang::getLocale();
        $customers = Customer::all();
        $items = Catalog::select($lang.'_name as name','id','price','categories_id',$lang.'_desc as desc','catalog_img','price')->where('id',$id)->get()->first();
        
        return view('frontend.pages.single_services_details',compact('items','customers'));
    }

    public function addToCart(Request $request){
        
        $lang = \Lang::getLocale();
        if (Session::has('cart')) {
            $cart = new Cart(Session::get('cart'));
        }else{
            $cart = new Cart();
        }

        if(isset($request->item_id) != null){

            $item = Catalog::select($lang.'_name as name','id','price')->where('id',$request->item_id)->get()->first();
            
            $cart->add($item);
            session()->put('cart',$cart);
        }
        if(isset($request->buffet_id) != null){
            
            $buffet = Buffet::findOrfail($request->buffet_id);
            $item = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes',$lang.'_desc','inventory_image')->where('id',$buffet->inventory_id)->get()->first();
            
            $cart->add($item);
            session()->put('cart',$cart);
        }
        if(isset($request->fromchoice_id) != null){
            
            $fromchoiceItem = FromChoiceItems::findOrfail($request->fromchoice_id);
            $item = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes',$lang.'_desc','inventory_image')->where('id',$fromchoiceItem->inventory_id)->get()->first();
            
            $cart->add($item);
            session()->put('cart',$cart);
        }
        if(isset($request->package_id) != null){
            
            $package = Package::findOrfail($request->package_id);
            $cart->addPackage($package);
            session()->put('cart',$cart);
            
        }
        
        

        

        return back();
    }

    public function viewCart(){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        }
        return view('frontend.pages.my_cart',compact('cart'));
    }

    public function removeChartItem($id){
        $cart = new Cart(session()->get('cart'));
        $cart->remove($id);

        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        }else{
            session()->put('cart',$cart);
        }
        return back();
    }

    public function sendMobileNumber(Request $request){
        $orders = [];
        $customers = Customer::all();
        $total_price = 0;
        $type = $request->type;
        
        for ($i=0; $i < count($request->quantity); $i++) { 
            array_push($orders,$request->ids[$i].'@'.$request->title[$i].'@'.$request->quantity[$i].'@'.$request->price[$i]);
            $total_price = $total_price + ($request->quantity[$i] * $request->price[$i]);
        }
        $orders = implode(',',$orders);
        
        
        return view('frontend.pages.mobilenumber',compact('total_price','orders','customers','type'));
    }

    public function sendMobileNumberPost(Request $request){
        $mobile = $request->mobile;
        $amount = $request->amount;
        $descriptions = $request->descriptions;
        $code = date('Y').rand(1,999);
        $sid = "AC4d53436a1f9568e1771cb7f4871e6d82"; // Your Account SID from www.twilio.com/console
        $token = "0ae735070c08135e953c0d89137f7fdd"; // Your Auth Token from www.twilio.com/console

        $client = new \Twilio\Rest\Client($sid, $token);
        $message = $client->messages->create(
            '+2'.$request->mobile, // Text this number
        array(
            'from' => '+13347212748', // From a valid Twilio number
            'body' => $code
        )
        );
        
        DB::select('delete from mobiles_codes where mobile = '.$mobile);
        DB::select('insert into mobiles_codes (mobile,code) values('.$mobile.','.$code.')');
        return view('frontend.pages.verifymobilenumber',compact('amount','code','descriptions','mobile'));

    }

    public function saveOrderMobile(Request $request){
        $code = DB::select('select code from mobiles_codes where mobile = '.$request->mobile)[0];
        if($code->code == $request->code){

        $customers = new Customer();
        $customers->mobile = $request->mobile;
        $customers->save();

        $total_price = $request->amount;
        $orders = $request->descriptions;

        $customer = Customer::findOrfail($customers->id);
        // dd($customer);
        
        return view('frontend.pages.checkout',compact('total_price','orders','customer'));

        }else{
            return back();
        }

        
    }

    public function checkoutCart(Request $request){
        $orders = [];
        $customers = Customer::all();
        $total_price = 0;
        for ($i=0; $i < count($request->quantity); $i++) { 
            array_push($orders,$request->ids[$i].'@'.$request->title[$i].'@'.$request->quantity[$i].'@'.$request->price[$i]);
            $total_price = $total_price + ($request->quantity[$i] * $request->price[$i]);
        }
        $orders = implode(',',$orders);
        
        return view('frontend.pages.checkout',compact('total_price','orders','customers'));
    }

    public function chargeCart(Request $request){
        // $setting = Setting::findOrfail(1);
        // $currency = '';
        // if($setting != null){
        //     if($setting->currency != ''){
        //         $currency = $setting->currency;
        //     }else{
        //         $currency = 'USD';
        //     }
        // }else{
        //     $currency = 'USD';
        // }

        $charge = Stripe::charges()->create([
           'currency' => 'USD',
           'source' =>  $request->stripeToken,
           'amount' => $request->amount,
           'description' => $request->descriptions,
           
        ]);

        $chargeId = $charge['id'];
        if ($chargeId) {
            $data = [];
            $order_data = [];
            
            $customer = Customer::findOrfail(19);

            $order = new Order();
            $order->order_code = 'ORDER_'.date('Y').rand(1,99);
            $order->customer_id = $customer->id;
            $order->company = $request->company;
            $order->address = $request->address;
            $order->order_day = $request->order_day;
            $order->order_from = $request->order_from;
            $order->order_to = $request->order_to;
            $order->no_attendance = $request->no_attendance;
            $order->total_price = $request->amount;
            $descs = explode(',',$request->descriptions);

            

            for ($i=0; $i < count($descs); $i++) {
                $desc = explode('@',$descs[$i]);
                $order_data['id_'.$i] = $desc[0];
                $order_data['title_'.$i] = $desc[1];
                $order_data['quantity_'.$i] = $desc[2];
                $order_data['total_'.$i] = $desc[3];
                
                
            }

            $order->order_data = json_encode($order_data);
            $customer->status = 1;
            $customer->save();
            
            if($request->follow_name != null){
                for ($i=0; $i < count($request->follow_name); $i++) { 
                    $data['follow_name_'.$i] = $request->follow_name[$i];
                    $data['follow_mobile_'.$i] = $request->follow_mobile[$i];
                    $data['follow_email_'.$i] = $request->follow_email[$i];
                }
        
                $order->followers = json_encode($data);
                $order->save();
                
            }else{
                $order->save();
            }

            session()->forget('cart');
            return redirect()->route('frontend_index')->with('success','');
        }else{
            $customer = Customer::findOrfail($request->customer_id);
            $customer->status = 2;
            $customer->save();
            return back();
        }
    }


    public function view_order($id){
        $order = Order::findOrfail($id);
        $lang = \Lang::getLocale();
        $items = Catalog::select($lang.'_name as name','id','price')->where('cataglog_id',$order->catalog_id)->get();
        return view('frontend.pages.view_order',compact('order','items'));
    }

    public function orderRate(Request $request)
    {
        if($request->ajax()){
            $rate_data = $request->rates;
            $order = $request->order;

            $reviews = new Order_Review();
            $reviews->order_id = $order;
            $reviews->comment = $rate_data[0];
            $reviews->rate = $rate_data[1];
            $reviews->save();
        }
    }

    public function services_search(Request $request)
    {
        $lang = \Lang::getLocale();
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();

        if(isset($request->searchBtn)){
            if($request->search != ''){
                $search = $request->search;
                $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id');
                $items = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','cataglog_id')->get();
                $catalogs->where($lang.'_name','like','%'.$request->search.'%')->orWhere($lang.'_desc','like','%'.$request->search.'%')->paginate(9);
                return view('frontend.pages.services_search',compact('category','catalogs','items','search'));
            }
        }

        if(isset($request->filterBtn)){

            if($request->from != '' && $request->to != ''){
                $from = $request->from;
                $to = $request->to;
                $catalogs = DB::select('SELECT catalogs.'.$lang.'_name as name,catalogs.id,catalogs.catalog_img,catalogs.'.$lang.'_desc as desc,catalogs.catalogs_id,SUM(catalog_items.total_price) FROM catalog_items INNER JOIN catalogs ON catalogs.id = catalog_items.cataglog_id GROUP BY catalog_items.cataglog_id HAVING sum BETWEEN '.$request->from.' AND '.$request->from);
                $items = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','cataglog_id')->get();
                $catalogs->where($lang.'_name','like','%'.$request->search.'%')->orWhere($lang.'_desc','like','%'.$request->search.'%')->paginate(9);
                return view('frontend.pages.services_search',compact('category','catalogs','items','from','to'));
            }

            if($request->from != ''){
                $from = $request->from;
                $catalogs = DB::select('SELECT catalogs.'.$lang.'_name as name,catalogs.id,catalogs.catalog_img,catalogs.'.$lang.'_desc as desc,catalogs.catalogs_id,SUM(catalog_items.total_price) FROM catalog_items INNER JOIN catalogs ON catalogs.id = catalog_items.cataglog_id GROUP BY catalog_items.cataglog_id HAVING sum = '.$request->from);
                $items = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','cataglog_id')->get();
                $catalogs->where($lang.'_name','like','%'.$request->search.'%')->orWhere($lang.'_desc','like','%'.$request->search.'%')->paginate(9);
                return view('frontend.pages.services_search',compact('category','catalogs','items','from'));
            }

            if($request->to != ''){
                $to = $request->to;
                $catalogs = DB::select('SELECT catalogs.'.$lang.'_name as name,catalogs.id,catalogs.catalog_img,catalogs.'.$lang.'_desc as desc,catalogs.catalogs_id,SUM(catalog_items.total_price) FROM catalog_items INNER JOIN catalogs ON catalogs.id = catalog_items.cataglog_id GROUP BY catalog_items.cataglog_id HAVING sum = '.$request->to);
                $items = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','cataglog_id')->get();
                $catalogs->where($lang.'_name','like','%'.$request->search.'%')->orWhere($lang.'_desc','like','%'.$request->search.'%')->paginate(9);
                return view('frontend.pages.services_search',compact('category','catalogs','items','to'));
            }
        }

        
                           
       
        
    }
 
    public function portfolio()
    {
        return view('frontend.pages.portfolio');
    }

    public function  contactus()
    {
        return view('frontend.pages.contactus');
    }

    public function  store_contactus(Request $request)
    {
        $this->validate($request, [
            'name'         =>  'required',
            'email'        =>  'required|email',
            'message'      =>  'required',
            'subject'   =>'required'
        ]);

        $data = array(
            'name'      =>  $request->name,
            'message'   =>   $request->message,
            'email'      =>   $request->email,
            'subject'      =>   $request->subject,

        );
        ContactUs::create($data);

        return redirect()->route('frontend_index')->with('success','');

    }

    public function termsConditions()
    {
        return view('frontend.pages.terms_conditions');
    }
   

}
