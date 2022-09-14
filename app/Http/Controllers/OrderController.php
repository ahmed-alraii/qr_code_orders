<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Restaurant;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $records = Order::all();
        if(auth()->user()->role->name === 'Employee'){
            $restaurants = $this->getEmployeeRestaurant()->first();
            $records = Order::where('restaurant_id' , $restaurants->id)
                ->where('order_status_id' , 1) // status : new order
                ->get();
        }

        return view('order.index')->with(['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    private function getEmployeeRestaurant() {
        return Restaurant::with('users')
            ->whereHas('users', function($query) {
                $query->where('user_id', auth()->id() );
            })->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data= $request->all();

        $order = Order::create($data);
        $this->addOrderItems($order , $data);
        Cart::destroy();
        return redirect()->route('restaurants_cards' )->with('message' , 'Order Sent Successfully');

    }

    private function addOrderItems($order ,$data): void
{
    foreach($data['cart'] as $items) {
        $items = json_decode($items);
        foreach ($items as $item) {
            $newItem = new MenuItem();
            $newItem->id = $item->id;
            $order->menuItems()->attach($newItem, ['quantity' => $item->qty]);

        }
    }
}


    public function show(Order $order)
    {
       return view('order.show' , ['record' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
