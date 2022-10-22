@extends('layouts.customer')

@section('content')
    <div class="container">
        <a class="btn btn-success mt-5" href="{{ route('restaurants_cards' , ['table_number' =>  base64_encode(1)]) }}">{{ __('Back') }}</a>
    </div>

    <div class="container mt-3">

        <h2 class="text-center mb-5 mt-3">{{ __('Menu Items') }} {{__('For')}}  {{$restaurant_name}} </h2>

                @if(session('message'))
                    <div class="alert alert-success text-center">
                        {{session('message')}}
                    </div>
                @endif

        <div class="row">
            <div>
                <p class="float-end bg-info p-3 text-white">
                    <i class="fa-xl fa-solid fa-cart-arrow-down"></i>
                    Cart : {{ $cart_count }}
                </p>
            </div>
        </div>
        @if(count($cart) > 0)
        <div class="row justify-content-end">
            <div class="col-sm-3 mb-3">
               <div class="card">
                   <div class="card-header text-center">
                       Items
                   </div>
                   <div class="card-body text-center">
                       Total Price : {{ number_format( $total , 3) }}
                      <div class="mt-3">
                          <form method="POST" action="{{route('orders.store')}}" >
                              @csrf
                              <input  type="hidden" name="order_status_id" value="1" /> {{-- Status : New  --}}
                              <input  type="hidden" name="table_number" value="{{base64_decode(request()->query('table_number'))}}" />
                              <input  type="hidden" name="restaurant_id" value="{{request()->query('restaurant_id')}}" />
                              <input  type="hidden" name="cart[]" value="{{$cart}}" />
                              <button type="submit" class="btn btn-primary"> Send Order</button>
                          </form>
                      </div>
               </div>
            </div>
        </div>
        @endif
        <div class="row mb-3">
            @foreach($records as $record)
                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <div class="card-header text-center">
                            Name : {{$record->name}}
                        </div>
                        <div class="card-body">
                            <img class="mb-3" height="200" width="100%" src="{{ Storage::url($record->image)}}"/>
                            <p> Price : {{number_format($record->price , 3)}} </p>

                            @if($cart->where('id' , $record->id)->count())
                                <form action="{{route('cart_remove')}}" method="POST">
                                    <input type="hidden" name="menu_item_id" value="{{$record->id}}">
                                    @csrf
                                    <div class="row justify-content-center">
                                    <input
                                        class="w-25 text-center col-1 mb-3 form-control" type="number" name="quantity"
                                        min="1"
                                        value="{{$cart->where('id' , $record->id)->first()->qty }}" readonly>

                                        <div class="text-center col-2 mt-1">
                                            <button class="btn btn-danger btn-sm ">X</button>
                                        </div>
                                    </div>


                                </form>
                            @else
                                <form action="{{route('cart_store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_item_id" value="{{$record->id}}">
                                    <div class="row justify-content-center">
                                        <input
                                               class="w-25 text-center col-1 mb-3 form-control" type="number" name="quantity"
                                               min="1"
                                               value="1" required>

                                        <div class="text-center col-2 mt-1">
                                            <button class="btn btn-success btn btn-sm">+</button>
                                        </div>
                                    </div>

                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

@endsection
