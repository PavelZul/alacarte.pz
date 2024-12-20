@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <form method="GET" action="{{ route('bookings.index') }}" class="mb-4">
            <div class="flex space-x-4">
                <select name="hotel_id" class="form-select">
                    <option value="">Выберите отель</option>

                </select>

                <input type="date" name="check_in" class="form-input" placeholder="Дата заезда">
                <input type="date" name="check_out" class="form-input" placeholder="Дата выезда">
                <input type="number" name="guests" class="form-input" placeholder="Количество человек">
                <button type="submit" class="btn btn-primary">Поиск</button>
            </div>
        </form>

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
            <tr>
                <th>Страна</th>
                <th>Отель</th>
                <th>Дата заезда</th>
                <th>Дата выезда</th>
                <th>Количество человек</th>
            </tr>
            </thead>
            <tbody>
            @foreach($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->check_in }}</td>
                    <td>{{ $hotel->check_out }}</td>
                    <td>{{ $hotel->guests }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $hotels->links() }}
    </div>
@endsection
