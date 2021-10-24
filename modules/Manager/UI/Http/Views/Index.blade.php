@extends('layouts.administrator')

@section('title', 'Список менеджеров')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('managers.create') }}" class="btn btn-success">Создать</a>
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
                @foreach($managers as $manager)
                <tr>
                    <td>{{ $manager->getId() }}</td>
                    <td>{{ $manager->getEmail()  }}</td>
                    <td><a href="{{ route('managers.show', ['id' => $manager->getId()]) }}">Подробнее</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
