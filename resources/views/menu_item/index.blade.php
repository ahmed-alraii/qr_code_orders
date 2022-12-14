@extends('layouts.app')

@section('content')

    <div class="container mt-0">
      <div class="row">

        <h2 class="text-center">{{ __('Menu Items') }} </h2>
          @can('create' , \App\Models\MenuItem::class)
        <div class="mb-3">
            <a href="{{route('menu_items.create')}}" class="btn-dark btn btn-sm mb-2 "> {{ __('Add') }}</a>
        </div>
          @endcan
      </div>

        <div class="row">

            <br>
            <div class="table-responsive bg-light ">
                <table id="tableCustomer" class="table">
                    <thead>
                    <tr>
                        <th> {{ __('Name') }} </th>
                        <th>{{ __('Price') }} </th>
                        <th>{{ __('Image') }} </th>
                        @if(auth()->user()->role_id === App\Models\Role::ADMIN)
                        <th>{{ __('Restaurant') }} </th>
                        @endif
                        <th>{{ __('Action') }} </th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ($records as $record)
                        <form
                            action="{{ route('menu_items.destroy' , ['menu_item' => $record->id] ) }}"
                            method="post">

                            <input type="hidden" name="id" value="{{ $record->id }}">
                            <tr>
                                <td>{{ $record->name }}</td>
                                <td>{{ number_format($record->price , 3) }}</td>
                                <td>
                                    <img width="100" height="100" src="{{  Storage::url( config('filesystems.menu_items_path') . $record->image)}}"/>
                                </td>
                              @if(auth()->user()->role_id === App\Models\Role::ADMIN)
                                <td>{{ $record->restaurant->name }}</td>
                              @endif
                                <td>
                                    <a href="{{ route('menu_items.edit', ['menu_item' => $record->id]) }}"
                                       class="btn btn-warning btn-sm text-light "> {{ __('Edit') }} </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick=" return confirm('Are You Sure?')"
                                            class=" btn btn-danger btn-sm">
                                        {{ __('Delete') }} </button>

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
        @if(count($records) > 0)
            <div class="mt-3">
                {{$records->links()}}
            </div>
        @endif

    </div>
@endsection

