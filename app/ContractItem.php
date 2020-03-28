<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractItem extends Model
{
    protected $table = 'contract_terms';

    public function terms($id)
    {
        $lang = \Lang::getLocale();
        $terms = \App\Term::select($lang.'_name as name','id',$lang.'_desc as desc')->where('id',$id)->get()->first();
        return $terms;
    }
}
