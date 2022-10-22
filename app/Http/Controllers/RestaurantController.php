<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{

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
        $image = $request->file('image');
        $folder = 'public/restaurants';
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
                $data['image'] = $image_url;
            }
        }

        if($image === null){
            $data['image'] = $folder . 'default_img.jpg';
        }

        $res =  Restaurant::create($data);

        if($res){
            return redirect()->route('restaurants.index');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
