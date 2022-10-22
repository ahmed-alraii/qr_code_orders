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
