<?php

namespace App;
use App\Catalog;
use App\Inventory;

class Cart
{
    public $items = [];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart = null){
        if($cart) {
            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    public function add($product){
        
        $item = [
            'id' => $product->id,
            'title' => $product->name,
            'price' => $product->price,
            'quantity' => 0,
            'type' => 'item'
        ];
        if( !array_key_exists($product->id, $this->items)) {
            $this->items[$product->id] = $item ;
            $this->totalQty +=1;
            $this->totalPrice += $product->price; 
        } else {
            $this->totalQty +=1 ;
            $this->totalPrice += $product->price; 
        }

        $this->items[$product->id]['quantity']  += 1 ;
    }

    public function addPackage($package)
    {
        $productName = \Lang::getLocale().'_name';
        $item = [
            'id' => $package->id,
            'title' => $package->$productName,
            'price' => $package->price,
            'quantity' => 0,
            'type' => 'package'
        ];

        if( !array_key_exists($package->id, $this->items)) {
            $this->items[$package->id] = $item ;
            $this->totalQty +=1;
            $this->totalPrice += $package->price; 
        } else {
            $this->totalQty +=1 ;
            $this->totalPrice += $package->price; 
        }

        $this->items[$package->id]['quantity']  += 1 ;
    }

    public function remove($id){
        if(array_key_exists($id, $this->items)) {
            $this->totalQty = $this->totalQty - $this->items[$id]['quantity'];
            $this->totalPrice = $this->totalPrice - ($this->items[$id]['quantity']*$this->items[$id]['price']);
            unset($this->items[$id]);
        }
    }

    public static function getMaxQty($id){
        if(Catalog::where('id',$id)->count() > 0){
            $item = Catalog::findOrfail($id);
            $inventory = Catalog::findOrfail($id);
        }else{
            $item = Inventory::findOrfail($id);
            $inventory = $item;
        }
        
       
        return $inventory->quantity;
    }
}
