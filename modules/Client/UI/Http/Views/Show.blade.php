@extends('layouts.administrator')

@section('title', 'Клиент')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('clients.index') }}" class="btn btn-primary">Список клиентов</a>
            <a href="{{ route('clients.edit', ['id' => $client->getId()]) }}" class="btn btn-success">Обновить</a>
            <form class="d-inline" action="{{ route('clients.destroy', ['id' => $client->getId()]) }}" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </div>
        <div>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Идентификатор</td>
                        <td>{{ $client->getId() }}</td>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td>{{ $client->getName() }}</td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>{{ $client->getPhoneNumber() }}</td>
                    </tr>
                    <tr>
                        <td>Количетсво посещений</td>
                        <td>{{ $client->getCountVisits() }}</td>
                    </tr>
                    <tr>
                        <td>Количетсво покупок</td>
                        <td>{{ $client->getCountBuy() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
