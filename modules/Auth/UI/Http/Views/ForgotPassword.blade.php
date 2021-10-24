@extends('layouts.empty')

@section('title', 'Забыль пароль')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; flex-direction: column">
        @if(session('status'))
            <div>{{ session('status')  }}</div>
        @endif
        <form action="{{ route('forgot_password.send') }}" method="post">
            @csrf
            <div class="row">
                <div class="mb-1">
                    <label class="form-label d-block">Почтовый ящик
                        <input type="email" name="email" class="form-control" placeholder="Введите почтовый ящик" value="{{ old('email', '') }}">
                    </label>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Отправить письмо</button>
                <a href="{{ route('login') }}" class="p-2 text-center">Авторизация</a>
            </div>
        </form>
    </div>
@endsection
