@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Система отчётности') }}</div>

                <div class="card-body d-flex flex-column align-items-center justify-content-center ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
@if (Auth::check()) 
    @hasanyrole('worker|manager|admin')
    <div>
    <p>
        Вы успешно авторизовались в системе!
    </p>    
</div>
    <a href="/panel">
        <br/>
    <button type="button" class="btn btn-secondary">Перейти к панели</button></a>
</div>
@else
    <div class="text-center">
        <p>Вы успешно авторизовались в системе!.</p>
        <p>Дождитесь подтверждения вашего аккаунта менеджером или администратором системы для получения доступа к панели.</p>
    </div>
@endhasanyrole

@else
<div class="text-center">
    <p>Авторизуйтесь для получения доступа к система!</p>
</div>
@endif

                    {{-- {{ __('You are logged in!') }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
