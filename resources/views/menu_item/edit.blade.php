@extends('layouts.app')

@section('content')

    <div class="container">


        <div class="error mt-3">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger text-center">{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <div class="row">
            <h2 class="text-center mt-3">{{ __('Edit') }} {{ __('Menu Item') }}  </h2>

            <div class="mb-5">
                <a href="{{ url()->previous() }}" class="btn-primary btn btn-sm mb-2 ">
                    {{ __('Back') }}
                </a>
            </div>
        </div>


        <form method="POST" action="{{route('menu_items.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="row justify-content-center">
                <div class="form-group  col-3 mb-3 ">
                    <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{$record->name}}"
                           class="form-control">

                </div>
            </div>

            <div class="row justify-content-center">
                <div class="form-group  col-3 mb-3 ">

                    <input type="number" step="0.001" name="price" placeholder="{{ __('Price') }}" value="{{$record->price}}"
                           class="form-control">
                </div>

            </div>

            <div class="row justify-content-center">
                <div class="form-group  col-3 mb-3 ">
                <select class="form-control"  name="restaurant_id" >
                    @foreach($restaurants as $restaurant)
                        <option value="{{$restaurant->id}}" >{{$restaurant->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="form-group  col-3 mb-3 ">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="form-group text-center col-3 mb-3 ">
                    <input type="submit" value="{{ __('Add') }} " class="btn btn-primary col-3 ">
                </div>
            </div>

        </form>
    </div>

@endsection
