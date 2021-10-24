@extends('layouts.administrator')

@section('title', 'Менеджер')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('managers.index') }}" class="btn btn-primary">Список менеджеров</a>
            <a href="{{ route('managers.edit', ['id' => $manager->getId()]) }}" class="btn btn-success">Обновить</a>
            <form class="d-inline" action="{{ route('managers.destroy', ['id' => $manager->getId()]) }}" method="POST">
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
                        <td>{{ $manager->getId() }}</td>
                    </tr>
                    <tr>
                        <td>Почтовый ящик</td>
                        <td>{{ $manager->getEmail() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
