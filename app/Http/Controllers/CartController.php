<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $item = MenuItem::findOrFail($request->input('menu_item_id'));
        $quantity = $request->input('quantity') ;
        Cart::add($item->id, $item->name, (int) $quantity, $item->price * $quantity );
        return redirect()->back()->with(['message'=> 'item added']  );
    }

    public function remove(Request $request)
    {
        $item = Cart::content()->where('id' , $request->input('menu_item_id'));
        foreach ($item as $key => $value) {
           unset(Cart::content()[$key]);
        }
        return redirect()->back()->with( 'message' ,'Item removed');
    }
}
