@extends('layouts.panel_layout')

@section('title', 'Отчёты')
@section('content')

    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
      <div class=" text-center pt-5 ">
      <h1>Список отчётов сотрудника {{$users->name}}</h1>
  </div>
  <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
    <div class="table-responsive w-75">
        <table class="table table-striped table-hover table-condensed">
          <thead>
            <tr>
              {{-- <th class="text-center"><strong>№</strong></th> --}}
              <th class="text-center"><strong>Дата</strong></th>
              <th class="text-center"><strong>Название</strong></th>
              <th class="text-center"><strong>Кратк.Содержание</strong></th>
              <th class="text-center"><strong>Действия</strong></th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($reports as $report)
            <tr>    
              <th>{{$report->created_at}}</th>
              <th>{{$report->title}}</th>
              <th>{{$report->desc}}</th>
              <th class="project-actions text-right">
                <button class="btn btn-secondary btn-sm open_modal" value="{{$users->id}}">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Просмотреть
                </button>
              </th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      </div> <!-- /.row-->

  @endsection