@extends('layouts.administrator')

@section('title', 'Обновление менеджера')

@section('content')
    <div class="p-3">
        <div>
            <a href="{{ route('managers.index') }}" class="btn btn-primary">Список менеджеров</a>
        </div>
        <div>
            <form action="{{ route('managers.update', ['id' => $manager->getId()]) }}" method="post">
                @method('patch')
                @csrf
                <div class="mb-1">
                    <label class="form-label d-block">Почтовый ящик
                        <input type="email" name="email" class="form-control" placeholder="Введите почтовый ящик" value="{{ old('email', $manager->getEmail()) }}">
                    </label>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        </div>
    </div>
@endsection
