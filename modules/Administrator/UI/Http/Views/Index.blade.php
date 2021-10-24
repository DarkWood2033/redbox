@extends('layouts.administrator')

@section('title', 'Список администраторов')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('administrators.create') }}" class="btn btn-success">Создать</a>
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>Идентификатор</th>
                    <th>Почтовый ящик</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($administrators as $administrator)
                <tr>
                    <td>{{ $administrator->getId() }}</td>
                    <td>{{ $administrator->getEmail()  }}</td>
                    <td><a href="{{ route('administrators.show', ['id' => $administrator->getId()]) }}">Подробнее</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
