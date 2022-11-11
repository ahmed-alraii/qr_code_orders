@extends('layouts.customer')

@section('content')

    <div class="container mt-3">

        <h2 class="text-center mb-5">{{ __('Restaurants') }} </h2>

        @if(session('message'))
            <div class="alert alert-success text-center">
                {{session('message')}}
            </div>
        @endif

        <div class="row mb-3 justify-content-center">
            @foreach($records as $record)
                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <div class="card-header text-center">
                            Name : {{$record->name}}
                        </div>
                        <div class="card-body ">
                            <img class="mb-3" height="200" width="100%"
                                 src="{{ Storage::url(config('filesystems.restaurant_path') . $record->image)}}"/>
                            <div class="row justify-content-center">
                                <div class=" text-center mt-1 ">
                                    <a class="non-decoration btn btn-secondary btn-sm"
                                       href="{{route('menu_items_cards' ,
                                       ['restaurant_id' => $record->id , 'restaurant_name' => $record->name , 'table_number' => request()->query('table_number')])}}"
                                     >Menus</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
