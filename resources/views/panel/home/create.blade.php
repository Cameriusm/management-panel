@extends('layouts.panel_layout')

@section('title', 'Создать отчёт')
@section('content')

    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
    <div class="container">
      <div class=" text-center pt-5 ">
      <h1>Создание отчёта за текущий день</h1>
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
                                      <div class="form-group"> <label for="form_name">Название *</label> <input id="form_name" type="text" name="title" class="form-control" placeholder="Пожалуйства введите название *" required="required" data-error="Название обязательно."> </div>
                                  </div>
                                 
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group"> <label for="form_email">Дата: </label> <input id="form_email" type="text" name="date" class="form-control" placeholder="Укажите дату *" required="required" readonly data-error="Дата обязательна." value="{{ \Carbon\Carbon::now()->toDateString() }}"></input> </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group"> <label for="form_message">Содержание *</label> <textarea id="form_message" name="desc" class="form-control" placeholder="Напишите содержание отчёта." rows="4" required="required" data-error="Содержание отчёта обязательно."></textarea> </div>
                                  </div>
                                  <div class="col-md-12"> <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Создать отчёт"> </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div> <!-- /.8 -->
      </div> <!-- /.row-->
  </div>
</div>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  @endsection