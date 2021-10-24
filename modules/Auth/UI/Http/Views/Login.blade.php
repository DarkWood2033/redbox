@extends('layouts.empty')

@section('title', 'Авторизация')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; flex-direction: column">
        @if(session('message')) {{ session('message') }} @endif
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="row">
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
                <button type="submit" class="btn btn-primary">Авторизоваться</button>
                <a href="{{ route('forgot_password.form') }}" class="p-2 text-center">Забыл пароль</a>
            </div>
        </form>
    </div>
@endsection
