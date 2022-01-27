@extends('layouts.panel_layout')

@section('title', 'Отчёты')
@section('content')

    <div class="container">
      <div class=" text-center pt-5 ">
      <h1>Список отчётов</h1>
  </div>
  <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
    <div class="table-responsive w-75">
        <table class="table table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th class="text-center"><strong>Дата</strong></th>
              <th class="text-center"><strong>Название</strong></th>
              <th class="text-center"><strong>Описание</strong></th>
              <th class="text-center"><strong>Автор</strong></th>
              <th class="text-center"><strong>Действия</strong></th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($reports as  $report)
            <tr>
              <th>{{$report->created_at}}</th>
              <th>{{$report->title}}</th>
              <th>{{$report->desc}}</th>
              <th>{{Auth::user()->where('id', $report->user_id)->value('name')}}</th>
              <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="#">
                  {{-- <a class="btn btn-info btn-sm" href="{{ route('post.edit', $post['id']) }}"> --}}
                      <i class="fas fa-pencil-alt">
                      </i>
                      Просмотреть
                  </a>
                  {{-- <a class="btn btn-info btn-sm" href="#">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Редактировать
                  </a> --}}
            </td>
              
            </tr>    
            @endforeach
          </tbody>
        </table>
      </div>
      </div> <!-- /.row-->

  @endsection