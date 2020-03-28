<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Contract;
use App\ContractItem;
use App\Term;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_contracts'))
            abort(403);

        $lang = \Lang::getLocale();
        $contracts = Contract::select($lang.'_name as name','id',$lang.'_content as desc')->get();
        return view('backend.pages.contracts.index',compact('contracts'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_contracts'))
            abort(403);
        return view('backend.pages.contracts.create');
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_contracts'))
            abort(403);

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);
        
        $contract = new Contract();

        $contract->en_name = $request->en_name;
        $contract->ar_name = $request->ar_name;
        $contract->en_content = $request->en_desc;
        $contract->ar_content = $request->ar_desc;


        
        $contract->save();

        return redirect()->route('contracts')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_contracts'))
            abort(403);
        $contract = Contract::findOrfail($id);
        $items = ContractItem::where('contract_id',$id)->get();
        return view('backend.pages.contracts.show',compact('contract','items'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_contracts'))
            abort(403);
        $contract = Contract::findOrfail($id);
        return view('backend.pages.contracts.edit',compact('contract'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_contracts'))
            abort(403);
        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);
        
        $contract = Contract::findOrfail($id);

        $contract->en_name = $request->en_name;
        $contract->ar_name = $request->ar_name;
        $contract->en_content = $request->en_desc;
        $contract->ar_content = $request->ar_desc;


        $contract->save();

        return redirect()->route('contracts')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_contracts'))
            abort(403);
        $contract = Contract::findOrfail($id)->delete();

        return redirect()->route('contracts')->with('success','');
    }

    public function terms_index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_contracts'))
            abort(403);
        $lang = \Lang::getLocale();
        $terms = Term::select($lang.'_name as name','id',$lang.'_desc as desc')->get();
        return view('backend.pages.terms.index',compact('terms'));
    }

    public function terms_create()
    {
        if(!Auth::user()->hasPermissionTo('create_contracts'))
            abort(403);
        $lang = \Lang::getLocale();
        $contracts = Contract::select($lang.'_name as name','id',$lang.'_content as desc')->get();
        return view('backend.pages.terms.create',compact('contracts'));
    }

    public function terms_store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_contracts'))
            abort(403);

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);
        
        $terms = new Term();

        $terms->en_name = $request->en_name;
        $terms->ar_name = $request->ar_name;
        $terms->en_desc = $request->en_desc;
        $terms->ar_desc = $request->ar_desc;

        $terms->save();

        if($request->contract_id > 0)
        {
            foreach ($request->contract_id as $contract) {
                $items = new ContractItem();
                $items->contract_id = $contract;
                $items->terms_id = $terms->id;
                $items->save();
            }   
        }

        return redirect()->route('terms_index')->with('success','');
    }

    public function terms_show($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_contracts'))
            abort(403);
        $terms = Term::findOrfail($id);
        return view('backend.pages.terms.show',compact('terms'));
    }

    public function terms_edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_contracts'))
            abort(403);
        $term = Term::findOrfail($id);
        $lang = \Lang::getLocale();
        $contracts = Contract::select($lang.'_name as name','id',$lang.'_content as desc')->get();
        $items = ContractItem::where('terms_id',$id)->get();
        $terms_items = [];
        foreach ($items as $item) {
            array_push($terms_items,$item->contract_id);
        }
        return view('backend.pages.terms.edit',compact('term','contracts','terms_items'));
    }

    public function terms_update($id,Request $request)
    {
        if(!Auth::user()->hasPermissionTo('edit_contracts'))
            abort(403);
        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);
        
        $term = Term::findOrfail($id);

        $term->en_name = $request->en_name;
        $term->ar_name = $request->ar_name;
        $term->en_desc = $request->en_desc;
        $term->ar_desc = $request->ar_desc;
        $term->save();

        if($request->contract_id > 0)
        {
             if(\DB::select('SELECT * FROM contract_terms WHERE terms_id = '.$id) != null){
                 //dd($request->contract_id);
                ContractItem::where('terms_id',$id)->delete();
                foreach ($request->contract_id as $contract) {
                    $items = new ContractItem();
                    $items->contract_id = $contract;
                    $items->terms_id = $id;
                    $items->save();
                }
            }else{
                foreach ($request->contract_id as $contract) {
                    $items = new ContractItem();
                    $items->contract_id = $contract;
                    $items->terms_id = $term->id;
                    $items->save();
                }
            }
        }

        return redirect()->route('terms_index')->with('success','');
    }

    public function terms_destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_contracts'))
            abort(403);
        $term = Term::findOrfail($id)->delete();

        return redirect()->route('terms_index')->with('success','');
    }

    public function contract_terms_delete($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_contracts'))
            abort(403);
        $items = ContractItem::where('terms_id',explode(',',$id)[1])->where('contract_id',explode(',',$id)[0]);
        $items->delete();
        return back();
    }

}
