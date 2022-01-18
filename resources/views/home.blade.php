@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body d-flex flex-column align-items-center justify-content-center ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<div>
<p>
    You are logged in!
</p>    
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
                    <a href="http://localhost/management-panel/public/panel">
                        <br/>
                    <button type="button" class="btn btn-secondary">Перейти к панели</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
