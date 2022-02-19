@extends('layouts.panel_layout')

@section('title', 'Создать отчёт')
@section('content')

<div class="container">
    <div class=" text-center pt-5 ">
    <h1>Создание отчёта</h1>
</div>
<div class="row ">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">
                <div class="container">
                    <form id="contact-form" action="{{ route('reports.store') }}" method="POST" role="form">
                    @csrf
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <label for="form_name">Автор *</label> <input id="form_name" type="text" readonly name="author" class="form-control" value="{{$user->id}} - {{$user->name}}" placeholder="Пожалуйства введите пользователя" required="required" data-error="Пользователь обязателен."></div>
                                </div>
                                <input hidden id="form_user_id" type="text" readonly name="user_id" value="{{$user->id}}"/>
                            </div>
                            @switch($author_role)
                            @case(2)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <label for="form_email">Дата: </label> <input id="form_email" type="text" name="date" class="form-control" placeholder="Укажите дату *" required="required" readonly data-error="Дата обязательна." value="{{ \Carbon\Carbon::now()->toDateString() }}"></input> </div>
                                </div>
                            </div>
                            @break
                            @case(3)
                            @if ($user->id == $author_id)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="form_email">Дата: </label> <input id="form_email" type="text" name="date" class="form-control" placeholder="Укажите дату *" required="required" readonly data-error="Дата обязательна." value="{{ \Carbon\Carbon::now()->toDateString() }}"></input> </div>
                                    </div>
                                </div>
                            @else 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <label for="form-date">Дата: </label> <input id="form-date" type="text" name="created_at" class="form-control" placeholder="Укажите дату *" required="required"  data-error="Дата обязательна." value="{{ \Carbon\Carbon::now()->toDateTimeString() }}"></input> </div>
                                </div>
                            </div>
                            @endif
                            @break
                            @case(4)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <label for="form-date">Дата: </label> <input id="form-date" type="text" name="created_at" class="form-control" placeholder="Укажите дату *" required="required"  data-error="Дата обязательна." value="{{ \Carbon\Carbon::now()->toDateTimeString() }}"></input> </div>
                                </div>
                            </div>
                            @break
                            @default      
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <label for="form_email">Дата: </label> <input id="form_email" type="text" name="date" class="form-control" placeholder="Укажите дату *" required="required" readonly data-error="Дата обязательна." value="{{ \Carbon\Carbon::now()->toDateString() }}"></input> </div>
                                </div>
                            </div>
                            @endswitch
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <label for="form_message">Содержание *</label> <textarea id="form_message" name="desc" class="form-control" placeholder="Напишите содержание отчёта." rows="4" required="required" data-error="Содержание отчёта обязательно."></textarea> </div>
                                </div>
                                <div class="col-md-12  text-center"> <input type="submit" class="btn btn-info btn-send pt-2 btn-block " value="Создать отчёт"> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection