<?php

namespace App;
use App\Category;
use App\CatalogItem;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    public function categoryName($id){
        $lang = \Lang::getLocale();
        return Category::select($lang.'_name as name','id',$lang.'_desc as desc')->where('id',$id)->get()->first();
    }

    public function getTotal($id)
    {
        $lang = \Lang::getLocale();
        $items = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price')->where('cataglog_id',$id)->get();
        $total = 0;
        foreach ($items as $item){
            $total = $total + ($item->quantity * $item->price);
        }
        return $total;

    }

    public static function getCatalogs($id)
    {
        $lang = \Lang::getLocale();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id')->where('categories_id',$id)->paginate(9);
        return $catalogs;
    }
    
}
