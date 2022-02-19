@extends('layouts.panel_layout')

@section('title', 'Отчёты')
@section('content')

<section class="content">
  <div class="container">
    <div class=" text-center pt-5 ">
    <h1>Список отчётов</h1>
  </div>
  <!-- Show download pdf section if user is not a worker -->
  @if ($author_role != 2) 
    <form action="{{ route('pdfview',['download'=>'pdf']) }}">
      <div class="container mt-5" style="max-width: 450px">
        <input class="form-control" name="dates" />
        <input id="start" name="start" type="hidden"/>
        <input id="end" name="end" type="hidden"/>
      </div>
      <div class="mt-3 d-flex justify-content-center">
        <button class="btn btn-danger btn-sm" type="submit">Download PDF</button>
      </div>
    </form>
  @endif
<div class="align-items-center mt-2  m-3 d-flex justify-content-center ">
  <div class="table-responsive w-75">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th class="text-center"><strong>№</strong></th>
            <th class="text-center"><strong>Дата</strong></th>
            <th class="text-center"><strong>Автор</strong></th>
            <th class="text-center"><strong>Кратк.содержание</strong></th>
            <th class="text-center"><strong>Действия</strong></th>
          </tr>
        </thead>
        <tbody class="text-center">
          @foreach ($reports as  $report)
          <tr class="report-row">
            <th>{{$report->id}}</th>
            <th class="report-date">{{$report->created_at->toDateString()}}</th>
            <th>{{Auth::user()->where('id', $report->user_id)->value('name')}}</th>
            <th class="text-center">{{ \Illuminate\Support\Str::limit($report->desc, 50, $end='...') }}</th>
            <th class="project-actions text-right d-flex justify-content-center">
              <button class="btn btn-info btn-sm btn_add open_modal_report" value={{$report->id}}>
                <i class="far fa-eye"></i>
              </button>
              <form action="{{ route('reports.edit', $report->id) }}">
                <button class="btn btn-warning btn-sm ml-3 mr-3" >
                  <i class="fas fa-pencil-alt">
                  </i>
                </button>
              </form>
              @if (Auth::user()->roles->pluck('name')[0] != ('worker'))
              <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                @method('DELETE')
                @csrf
              <button class="btn btn-danger btn-sm" >
                <i class="fas fa-trash"></i>
              </button>
            </form>
              @endif
            </th>
          </tr>    
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
    <input id="url" type="hidden" value="{{ \Request::url() }}">
    <!-- MODAL SECTION -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Отчёт номер</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="formModal" name="formModal" class="form-horizontal" novalidate="">
              <div class="form-group created-form">
                <label for="inputDetail" class="col-sm-3 control-label">Дата</label>
                <div class="col-sm-9">
                  <input readonly type="text" class="form-control" id="created_at" name="created_at" placeholder="Дата" value="">
                </div>
              </div>
              <div class="form-group desc-form">
                <label for="inputDetail" class="col-sm-3 control-label">Содержание</label>
                <div class="col-sm-9">
                  <textarea readonly class="form-control" id="desc" name="desc" placeholder="Содержание" >
                  </textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button hidden type="submit" class="btn btn-primary" id="btn-add">Создать отчёт</button>
                <input type="hidden" id="user_id" name="user_id" value="">
            </div>
            </form>
          </div>
    </div>

  @endsection