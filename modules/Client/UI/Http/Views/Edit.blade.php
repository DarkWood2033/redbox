@extends('layouts.administrator')

@section('title', 'Обновление клиента')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('clients.index') }}" class="btn btn-primary">Список клиентов</a>
        </div>
        <div>
            <form action="{{ route('clients.update', ['id' => $client->getId()]) }}" method="post">
                @method('patch')
                @csrf
                <div class="mb-1">
                    <label class="form-label d-block">Имя
                        <input type="text" name="name" class="form-control" placeholder="Введите имя" value="{{ old('name', $client->getName()) }}">
                    </label>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        </div>
    </div>
@endsection
