@extends('layouts.administrator')

@section('title', 'Обновление администратора')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('administrators.index') }}" class="btn btn-primary">Список администраторов</a>
        </div>
        <div>
            <form action="{{ route('administrators.update', ['id' => $administrator->getId()]) }}" method="post">
                @method('patch')
                @csrf
                <div class="mb-1">
                    <label class="form-label d-block">Почтовый ящик
                        <input type="email" name="email" class="form-control" placeholder="Введите почтовый ящик" value="{{ old('email', $administrator->getEmail()) }}">
                    </label>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        </div>
    </div>
@endsection
