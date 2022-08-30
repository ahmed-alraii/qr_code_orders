<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addUser(Request $request)
    {
        $data = $request->all();
        $this->validator($data);
        $user = $this->create($data);
        $restaurant = Restaurant::findOrFail($data['restaurant_id']);
        $restaurant->users()->attach($user);
        return redirect()->route('register')->with(['message' => 'User Added']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);
    }

    public function showQrCodeForm()
    {
        return view('admin.qr_code');
    }

    public function generateQrCode(Request $request)
    {
        $data = $request->all();
        $path = "app/public/qr_code/";
        $qr_code_img_name = 'code_' .time() . '.png';
        $link = "http://qr-code-orders.test/restaurants_cards?table_number=".base64_encode($data["number"]);
        $qrCode  =  QrCode::format('png')->size(900)->generate($link);
        QrCode::format('png')->size(250)->generate($link , storage_path($path . $qr_code_img_name) );
        Session::flash('qr_image' , $qr_code_img_name);

        return redirect()->back()->with( ['qrCode' => $qrCode]);
    }
}
