@extends('layouts.manager')

@section('content')
    <div class="p-3">
        <div>
            @if(session('message')) {{ session('message') }} @endif
            <form action="{{ route('visits.fix', ['client_id' => $client->getId()]) }}" method="post">
                @csrf
                <div class="mb-1">
                    <label class="form-label d-block">Сумма
                        <input type="text" name="amount" class="form-control" placeholder="Введите сумму" value="{{ old('amount', '') }}">
                    </label>
                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @if($discount)
                    <div>Ваше скидка составляет: {{ $discount->getAmount() }}</div>
                @endif
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
@endsection
