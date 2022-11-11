@extends('layouts.app')

@section('content')

    <div class="container mt-0">
      <div class="row">

        <h2 class="text-center">{{ __('Users') }} </h2>

        <div class="mb-3">
            <a href="{{route('register')}}" class="btn-dark btn btn-sm mb-2 "> {{ __('Add') }}</a>
        </div>

          @if(\Illuminate\Support\Facades\Session::has('message'))
              <div class="alert alert-success text-center">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
          @endif

      </div>

        <div class="row">

            <br>
            <div class="table-responsive bg-light ">
                <table id="tableCustomer" class="table">
                    <thead>
                    <tr>
                        <th> {{ __('Name') }} </th>
                        <th> {{ __('Type') }} </th>
                        <th>{{ __('Action') }} </th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ($records as $record)
                        <form
                            action="{{ route('users.destroy' , ['user' => $record->id] ) }}"
                            method="post">
                            <input type="hidden" name="id" value="{{ $record->id }}">
                            <tr>
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->role->name }}</td>
                                <td>
                                    <a href="{{ route('users.edit', ['user' => $record->id]) }}"
                                         class="btn btn-warning btn-sm text-light "> {{ __('Edit') }} </a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick=" return confirm('Are You Sure?')"
                                            class=" btn btn-danger btn-sm">
                                        {{ __('Delete ') }} </button>

                                </td>
                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>


                @if (count($records) === 0)
                    <div class="text-center">
                        <h4> {{ __('No Data') }} </h4>
                    </div>
                @endif
            </div>

        </div>

    </div>
@endsection

