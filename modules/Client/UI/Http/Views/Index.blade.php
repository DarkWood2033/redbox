@extends('layouts.administrator')

@section('title', 'Список клиентов')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('clients.create') }}" class="btn btn-success">Создать</a>
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>Идентификатор</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->getId() }}</td>
                    <td>{{ $client->getName()  }}</td>
                    <td>{{ $client->getPhoneNumber()  }}</td>
                    <td><a href="{{ route('clients.show', ['id' => $client->getId()]) }}">Подробнее</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
