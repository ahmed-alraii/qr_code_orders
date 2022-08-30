@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add QR-Code') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('generate_qr_code')}}" class="mr">
                            @csrf
                            <div class="row">
                                <div class="col-6 ">
                                    <input type="number" min="1" max="10" name="number" class="bg-gray pd form-control"
                                           placeholder="please enter table number" required/>
                                </div>
                                <div class="col-6 ">

                                    <input type="submit" class="btn btn-secondary" value="Generate QR Code">
                                </div>
                            </div>
                        </form>
                        @if(session()->has('qrCode'))
                            <img  width="400" height="400" src="data:image/png;base64 , {!! base64_encode(session('qrCode')) !!}" />
                            <a  class="btn btn-secondary" href="{{asset( 'storage/qr_code/' . \Illuminate\Support\Facades\Session::get('qr_image'))}}" download>Download Image</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
