@extends('layouts.administrator')

@section('title', 'Администратор')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('administrators.index') }}" class="btn btn-primary">Список администраторов</a>
            <a href="{{ route('administrators.edit', ['id' => $administrator->getId()]) }}" class="btn btn-success">Обновить</a>
            <form class="d-inline" action="{{ route('administrators.destroy', ['id' => $administrator->getId()]) }}" method="POST">
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
                        <td>{{ $administrator->getId() }}</td>
                    </tr>
                    <tr>
                        <td>Почтовый ящик</td>
                        <td>{{ $administrator->getEmail() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
