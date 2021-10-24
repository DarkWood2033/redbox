@extends('layouts.default')

@section('menu')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('administrators.index') }}">Администраторы</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('managers.index') }}">Менеджеры</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('clients.index') }}">Клиенты</a>
    </li>
@endsection
