@extends('layouts.app')

@section('content')

    <div class="container">
        <a class="btn btn-success mt-5" href="{{ route('users.index') }}">{{ __('Back') }}</a>
    </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('add_user') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('User Role') }}</label>

                            <div class="col-md-6">

                               <select class="form-control"  name="role_id"  onchange="onSelectRole(event)" >
                                   @foreach($roles as $role)
                                   <option value="{{$role->id}}" >{{$role->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>

                        <div class="row mb-3" id="restaurants">
                            <label  class="col-md-4 col-form-label text-md-end">{{ __('Restaurants') }}</label>

                            <div class="col-md-6">

                                <select class="form-control"  name="restaurant_id"  >
                                    @foreach($restaurants as $restaurant)
                                        <option value="{{$restaurant->id}}" >{{$restaurant->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{asset("vendor/jquery/jquery.min.js")}}"></script>
<script>

    $(document).ready(function (){
        $('#restaurants').hide();
    });

    function onSelectRole(restaurant){
     let restaurant_id = restaurant.target.value;
     if(restaurant_id === "2"){
         $('#restaurants').show();
     }else{
         $('#restaurants').hide();
     }
    }

</script>
