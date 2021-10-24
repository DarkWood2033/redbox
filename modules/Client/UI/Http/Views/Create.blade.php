@extends('layouts.administrator')

@section('title', 'Создание клиента')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('clients.index') }}" class="btn btn-primary">Список клиентов</a>
        </div>
        <div>
            <form action="{{ route('clients.store') }}" method="post">
                @csrf
                <div class="mb-1">
                    <label class="form-label d-block">Имя
                        <input type="text" name="name" class="form-control" placeholder="Введите имя" value="{{ old('name', '') }}">
                    </label>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label d-block">Телефон
                        <input type="text" name="phone_number" class="form-control" placeholder="Введите телефон" value="{{ old('phone_number', '') }}">
                    </label>
                    @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </div>
@endsection
