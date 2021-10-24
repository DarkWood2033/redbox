@extends('layouts.administrator')

@section('title', 'Создание администратора')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('administrators.index') }}" class="btn btn-primary">Список администраторов</a>
        </div>
        <div>
            <form action="{{ route('administrators.store') }}" method="post">
                @csrf
                <div class="mb-1">
                    <label class="form-label d-block">Почтовый ящик
                        <input type="email" name="email" class="form-control" placeholder="Введите почтовый ящик" value="{{ old('email', '') }}">
                    </label>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label d-block">Пароль
                        <input type="password" name="password" class="form-control" placeholder="Введите пароль">
                    </label>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label d-block">Повторный пароль
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Введите повторный пароль">
                    </label>
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </div>
@endsection
