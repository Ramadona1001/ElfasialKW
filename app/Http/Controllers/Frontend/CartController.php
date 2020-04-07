<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Order;
use App\MainOrder;
use Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Catalog;
use App\CatalogItem;
use App\Buffet;
use App\Package;
use App\PackageItem;

class CartController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(
            'cart',
            'store',
            'update',
            'remove',
            'destroy'
        );
    }

    public function cart()  {
        
        return view('frontend.pages.cart.cart');
    }

    public function store(Request $request)
    {

        if ($request->type == 'catalog') {
            $catalog = CatalogItem::findOrfail($request->catalog_id);
            $options = [];
            $options[] = 'catalog';
            
            Cart::add(
                $request->catalog_id,
                $request->catalog_name,
                $request->quantity,
                $request->price,
                $options
            );

            return back()->with('success',__('tr.Catalog Added Successfully'));
        }

        if ($request->type == 'buffet') {
            $buffet = Buffet::findOrfail($request->buffet_id);
            $options = [];
            $options[] = 'buffet';
            
            Cart::add(
                $request->buffet_id,
                $request->buffet_name,
                $request->quantity,
                $request->price,
                $options
            );

            return back()->with('success',__('tr.Buffet Added Successfully'));
        }

        if ($request->type == 'package') {
            $package = Package::findOrfail($request->package_id);
            $options = [];
            $options[] = 'package';
            
            Cart::add(
                $request->package_id,
                $request->package_name,
                $request->quantity,
                $request->price,
                $options
            );

            return back()->with('success',__('tr.Package Added Successfully'));
        }
        
        
    }

    public function update($id,Request $request)
    {
        $cart = Cart::get($id);
        $price = $cart->price;
        $qty = $cart->qty;
        $newQty = $request->quantity;
        $newPrice = $newQty * $price;
        $products = [
            'price' => $newPrice,
            'qty' => $newQty
            
            
        ];

        // Cart::update($id, ('name'));
        return back()->with('success',__('tr.Cart Updated Successfully'));
    }

    public function remove($id)
    {
        Cart::remove($id);
        return back()->with('success',__('tr.Item Removed Successfully'));
    }

    public function destroy()
    {
        Cart::destroy();
        return redirect()->route('frontend_index')->with('success',__('tr.Cart is Empty Now'));
    }

    public function checkout()
    {
        return view('frontend.pages.cart.checkout');
    }

    public function checkoutPost(Request $request)
    {
        $total = Cart::subtotal();
        $data = [];
        $charge = Stripe::charges()->create([
            'currency' => 'USD',
            'source' =>  $request->stripeToken,
            'amount' => $total,
            'description' => 'Order',
            
         ]);

        //  Cart::store('Order#'.rand(1,999));

         $mainOrder = new MainOrder();
         $mainOrder->code = 'ORDER #'.rand(1,999);
         $mainOrder->user_phone = $request->mobile;
         $mainOrder->address = $request->address;
         $mainOrder->quantity = Cart::count();
         $mainOrder->price = Cart::subtotal();
         $mainOrder->order_day = $request->order_day;
         if($request->follow_name != null){
            for ($i=0; $i < count($request->follow_name); $i++) { 
                $data['follow_name_'.$i] = $request->follow_name[$i];
                $data['follow_mobile_'.$i] = $request->follow_mobile[$i];
                $data['follow_email_'.$i] = $request->follow_email[$i];
            }
    
            $mainOrder->followers = json_encode($data);
            $mainOrder->save();
            
        }else{
            $mainOrder->save();
        }
         $mainOrder->save();


         foreach (Cart::content() as $item) {
             $order = new Order();
             $order->mainorder_id = $mainOrder->id;
             $order->name = $item->name;
             $order->order_id = $item->id;
             $order->quantity = $item->qty;
             $order->price = $item->price;
             $order->save();
         }

         
         Cart::destroy();
         return redirect()->route('frontend_index')->with('success',__('tr.Payment Process is Done'));

        
    }

    public function invoices($id)
    {
        $mainOrder = MainOrder::findOrfail($id);
        $order = Order::where('mainorder_id',$id)->get();
        return view('frontend.pages.cart.invoices',compact('mainOrder','order'));
    }
}
