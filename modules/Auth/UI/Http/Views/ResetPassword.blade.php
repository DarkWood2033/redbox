@extends('layouts.empty')

@section('title', 'Сбросить пароль')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; flex-direction: column">
        @if(session('status'))
            <div>{{ session('status')  }}</div>
        @endif
        <form action="{{ route('reset_password.reset') }}" method="post">
            @csrf
            <div class="row">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="hash" value="{{ $hash }}">
                <div class="mb-1">
                    <label class="form-label d-block">Новый пароль
                        <input type="password" name="password" class="form-control" placeholder="Введите новый пароль">
                    </label>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label d-block">Повторный пароль
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Введите повторный пароль">
                    </label>
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Сбросить пароль</button>
            </div>
        </form>
    </div>
@endsection
