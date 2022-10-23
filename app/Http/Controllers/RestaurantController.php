<?php

namespace App\Http\Controllers;

use App\Helpers\StoreFileTrait;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    use StoreFileTrait;

    private string $path = 'public/images/restaurants/';

    public function index()
    {
        $records = Restaurant::all();

        return view('restaurant.index' , compact('records'));
    }

    public function indexCards()
    {
        $records = Restaurant::all();
        return view('restaurant.index_cards' , compact('records') );
    }


    public function create()
    {
        return view('restaurant.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $restaurant =  Restaurant::create($data);
        $image_name = $this->storeImage($request , $restaurant , $this->path);
        $restaurant->image = $image_name;
        $restaurant->save();
        return redirect()->route('restaurants.index');
    }


    public function show(Restaurant $restaurant)
    {
        //
    }

    public function edit(Restaurant $restaurant)
    {

        return view('restaurant.edit', ['record' => $restaurant]);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $data = $request->all();
        $image_name = $this->storeImage($request , $restaurant , $this->path);
        $data['image'] = $image_name;
        $restaurant->update($data);
        return redirect()->route('restaurants.index');
    }


    public function destroy(Restaurant $restaurant)
    {

        if( $restaurant->image !== 'default_img.png'){
            Storage::delete($this->path . $restaurant->image);
        }

        $restaurant->delete();
        return redirect()->route('restaurants.index');
    }
}
