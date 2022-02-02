@extends('layouts.panel_layout')

@section('title', 'Отчёты')
@section('content')

    <div class="container">
      <div class=" text-center pt-5 ">
      <h1>Список отчётов</h1>
    </div>
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


{{-- <div class="text-center"> <input type="submit" class="btn btn-info btn-send pt-2 btn-block " value="Скачать PDF"> </div> --}}

  <div class="align-items-center mt-2  m-3 d-flex justify-content-center ">
    <div class="table-responsive w-75">
        <table class="table table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th class="text-center"><strong>№</strong></th>
              <th class="text-center"><strong>Дата</strong></th>
              <th class="text-center"><strong>Автор</strong></th>
              <th class="text-center"><strong>Название</strong></th>
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
              <th>{{$report->title}}</th>
              <th>{{$report->desc}}</th>
              <th class="project-actions text-right d-flex justify-content-center">
                <button class="btn btn-info btn-sm btn_add open_modal_report" value={{$report->id}}>
                  <i class="far fa-eye"></i>
         
                </button>
                <form action="{{ route('list.edit', $report->id) }}">
                  <button class="btn btn-warning btn-sm ml-3 mr-3" >
                    <i class="fas fa-pencil-alt">
                    </i>
                  </button>
                </form>
                <button class="btn btn-danger btn-sm" >
                 <i class="fas fa-trash"></i>
                 
                </button>
              </th>
              
            </tr>    
            @endforeach
          </tbody>
        </table>
      </div>
      </div> <!-- /.row-->




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
        <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
          <div class="form-group error">
            <label for="inputName" class="col-sm-3 control-label" >Название</label>
            <div class="col-sm-9">
              <input readonly type="text" class="form-control has-error" id="title" name="title" placeholder="Product Name" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputDetail" class="col-sm-3 control-label">Дата</label>
            <div class="col-sm-9">
              <input readonly type="text" class="form-control" id="date" name="date" placeholder="Дата" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputDetail" class="col-sm-3 control-label">Содержание</label>
            <div class="col-sm-9">
              <textarea readonly class="form-control" id="desc" name="desc" placeholder="Содержание" >
              </textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-primary" id="btn-save" value="update">Сохранить изменения</button> --}}
        <input type="hidden" id="user_id" name="user_id" value="">
      </div>
    </div>

  @endsection