<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\Role;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Helpers\StoreFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    use StoreFileTrait;

    private string $path = 'public/images/menu_items/';

    public function index()
    {
        $records = MenuItem::all();

        if (auth()->user()->role_id === Role::EMPLOYEE) {
            $restaurant = $this->getEmployeeRestaurant()->first();
            $records = MenuItem::where('restaurant_id', $restaurant->id)->get();
        }

        return view('menu_item.index', compact('records'));
    }

    private function getEmployeeRestaurant()
    {
        return Restaurant::with('users')
            ->whereHas('users', function ($query) {
                $query->where('user_id', auth()->id());
            })->get();
    }

    public function indexCards(Request $request)
    {
        $restaurant_id = $request->input('restaurant_id');
        $restaurant_name = $request->input('restaurant_name');
        $records = MenuItem::where('restaurant_id', $restaurant_id)->get();
        $cart_count = Cart::content()->count();
        $cart = Cart::content();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->price;
        }
        return view('menu_item.index_cards', compact('records', 'cart_count', 'cart', 'total', 'restaurant_name'));
    }

    public function create()
    {
        $this->authorize('create' , MenuItem::class);
        $restaurants = $this->getRestaurants();
        return view('menu_item.create', compact('restaurants'));
    }

    public function getRestaurants()
    {
        $restaurants = Restaurant::all();
        if (auth()->user()->role_id === Role::EMPLOYEE) {
            $restaurants = $this->getEmployeeRestaurant();
        }
        return $restaurants;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $menuItem = MenuItem::create($data);
        $image_name = $this->storeImage($request , $menuItem , $this->path);
        $menuItem->image = $image_name;
        $menuItem->save();
        return redirect()->route('menu_items.index');
    }


    public function show(MenuItem $menuItem)
    {
        //
    }

    public function edit(MenuItem $menuItem)
    {
        $restaurants = $this->getRestaurants();
        return view('menu_item.edit', ['record' => $menuItem, 'restaurants' => $restaurants]);
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $data = $request->all();
        $image_name = $this->storeImage($request , $menuItem , $this->path);
        $data['image'] = $image_name;
        $menuItem->update($data);
        return redirect()->route('menu_items.index');
    }


    public function destroy(MenuItem $menuItem)
    {

        if( $menuItem->image !== 'default_img.png'){
            Storage::delete($this->path . $menuItem->image);
        }

        $menuItem->delete();
        return redirect()->route('menu_items.index');
    }
}
