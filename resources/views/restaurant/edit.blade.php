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
            <h2 class="text-center mt-3">{{ __('Edit') }} {{ __('Restaurant') }} </h2>

            <div class="mb-5">
                <a href="{{ url()->previous() }}" class="btn-primary btn btn-sm mb-2 ">
                    {{ __('Back') }}
                </a>
            </div>
        </div>


        <form method="POST" action="{{route('restaurants.update' , $record->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="form-group  col-3 mb-3 ">
                    <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{$record->name}}"
                           class="form-control">

                </div>
            </div>

            <div class="row justify-content-center">
                <div class="form-group  col-3 mb-3 ">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="form-group text-center col-3 mb-3 ">
                    <input type="submit" value="{{ __('Update') }} " class="btn btn-primary col-3 ">
                </div>
            </div>

        </form>
    </div>

@endsection
