@extends('layouts.app')

@section('content')

    <div class="container mt-0">
      <div class="row">

        <h2 class="text-center mb-5">{{ __('New Orders') }} </h2>

      </div>

        <div class="row justify-content-center">

            <br>
            <div class="table-responsive bg-light ">
                <table id="tableCustomer" class="table">
                    <thead>
                    <tr>
                        <th class="text-center"> {{ __('Id') }} </th>
                        <th class="text-center"> {{ __('Table Number') }} </th>
                        <th class="text-center"> {{ __('Items') }} </th>
                        <th class="text-center"> {{ __('Actions') }} </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($records as $record)
                            <input type="hidden" name="id" value="{{ $record->id }}">
                            <tr>
                                <td class="text-center">{{ $record->id }}</td>
                                <td class="text-center">{{ $record->table_number }}</td>
                                <td class="text-center">{{count($record->menuItems)}}</td>
                                <td class="text-center">

                                    <a href="{{ route('orders.show', ['order' => $record->id]) }}"
                                       class="btn btn-info btn-sm text-light "> {{ __('View') }} </a>
                                </td>
                            </tr>
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

