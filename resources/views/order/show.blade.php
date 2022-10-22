@extends('layouts.app')

@section('content')

    <div class="container mt-0">
        <div class="row">

            <h2 class="text-center mb-5">{{ __('Order Details') }} </h2>

        </div>

        <div class="row justify-content-center">

            <br>
            <div class="col-sm-4">
                <table id="tableCustomer" class="table bg-light">
                    <thead>
                    <tr>
                        <th class="text-center"> {{ __('Id') }} </th>
                        <th class="text-center"> {{ __('Table Number') }} </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">{{ $record->id }}</td>
                        <td class="text-center">{{ $record->table_number }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-center">
                <h2 class="text-center mt-3">{{ __('Items List') }} </h2>
                <table id="tableCustomer" class="table bg-light mt-3">
                    <thead>
                    <tr>
                        <th class="text-center"> {{ __('Id') }} </th>
                        <th class="text-center"> {{ __('Name') }} </th>
                        <th class="text-center"> {{ __('Quantity') }} </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($record->menuItems as $item)

                        <tr>
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="text-center">{{ $item->name }}</td>
                            <td class="text-center">{{ $item->pivot->quantity }}</td>
                    @endforeach
                    </tbody>
                </table>

                @if (count($record->menuItems) === 0)
                    <div class="text-center">
                        <h4> {{ __('No Data') }} </h4>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection

