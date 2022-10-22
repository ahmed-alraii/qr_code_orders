<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Restaurant;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{

    public function index()
    {
        $records = MenuItem::all();

        if(auth()->user()->role->name === 'Employee'){
           $restaurant = $this->getEmployeeRestaurant()->first();
            $records = MenuItem::where('restaurant_id' , $restaurant->id)->get();
        }

        return view('menu_item.index' , compact('records' ));
    }

    public function indexCards(Request $request)
    {
        $restaurant_id = $request->input('restaurant_id');
        $restaurant_name = $request->input('restaurant_name');
        $records = MenuItem::where('restaurant_id' , $restaurant_id)->get();
        $cart_count = Cart::content()->count();
        $cart = Cart::content();
        $total = 0;
        foreach ($cart as $item){
            $total += $item->price;
        }
        return view('menu_item.index_cards' , compact( 'records' ,'cart_count' , 'cart' , 'total' , 'restaurant_name'));
    }


    public function create()
    {
        $restaurants = $this->getRestaurants();
        return view('menu_item.create' , compact('restaurants'));
    }

    private function getEmployeeRestaurant() {
      return Restaurant::with('users')
            ->whereHas('users', function($query) {
                $query->where('user_id', auth()->id() );
            })->get();
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $folder = 'public/menu_items';
        if($image !== null) {
            $ext = $image->getClientOriginalExtension();
            $validExtensions = ['png', 'jpg', 'jpeg'];

            if ($image->isFile()) {
                if (!in_array($ext, $validExtensions)) {
                    Session::flash('message', 'Image Not Valid.');
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back()->withInput();
                }
                $image_url = Storage::putFile($folder, $image);
                $image_url_array = explode('/' , $image_url);
                $image_name = $image_url_array[2];
                $data['image'] = $image_name;
            }
        }

        if($image === null){
            $data['image'] = $folder . 'default_img.jpg';
        }

        $res =  MenuItem::create($data);

        if($res){
            return redirect()->route('menu_items.index');
        }

        return redirect()->back()->withInput();
    }

    public function show(MenuItem $menuItem)
    {
        //
    }


    public function edit(MenuItem $menuItem)
    {
        $restaurants = $this->getRestaurants();
        return view('menu_item.edit' , ['record' => $menuItem , 'restaurants' => $restaurants]);
    }

    public function getRestaurants()
    {
        $restaurants = Restaurant::all();
        if(auth()->user()->role->name === 'Employee'){
            $restaurants = $this->getEmployeeRestaurant();
        }
        return $restaurants;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuItem  $munuItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItem $munuItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuItem  $munuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $munuItem)
    {
        //
    }
}
