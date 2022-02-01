@extends('layouts.panel_layout')

@section('title', 'Список отчётов')
@section('content')
    <div class="container">
      <div class=" text-center pt-5 ">
      <h1>Список сотрудников</h1>
  </div>
  <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
    <div class="table-responsive w-75">
      <table class="table table-striped table-hover table-condensed">
         <div> Сегодня: {{\Carbon\Carbon::now()->timezone('Asia/Krasnoyarsk')->toDateString()}} </div>
          <thead>
            <tr>
              <th class="text-center"><strong>№</strong></th>
              <th class="text-center"><strong>Имя</strong></th>
              <th class="text-center"><strong>Почта</strong></th>
              <th class="text-center"><strong>Кол-во отчётов</strong></th>
              <th class="text-center"><strong>Отчёт за сегодня</strong></th>
              <th class="text-center"><strong>Действия</strong></th>
            </tr>
        </thead>
          <tbody>
              @foreach ($users as $user)
              <tr class="text-center">
                <th>{{$user->id}}</th>
                <th>{{$user->name}}</th>
                <th>{{$user->email}}</th>
                <th>{{count($user->reports)}}</th>
                <th>
                  @if (!empty($user->reports->sortByDesc('created_at')->first()))
                    @if ($user->reports->sortByDesc('created_at')->first()->created_at->toDateString() == \Carbon\Carbon::now()->timezone('Asia/Krasnoyarsk')->toDateString())
                     {{-- <span class="text-info">Сдан</span> --}}
                     <button title="Посмотреть отчёт" class="btn btn-info btn-detail btn-sm btn_add open_modal_report" data-toggle="tooltip" value="{{$user->reports->sortByDesc('created_at')->first()->id}}">
                      <i class="fas fa-eye">
                      </i>
                  
                    </button>
                    <form
                    action="{{ route('list.edit', $user->reports->sortByDesc('created_at')->first()->id)}}" class="d-inline">
                    <button title="Редактировать отчёт" class="btn btn-info btn-detail btn-sm open_modal" data-toggle="tooltip" value="{{$user->id}}">
                      <i class="fas fa-pencil-alt">
                      </i>
                      
                    </button>
                    </form>
                     @else
                     {{-- <span class="text-dark">Не Сдан</span> --}}
                     <form
                          action="{{ route('reports.create', $user->id)}}" class="d-inline">
                          <button title="Создать отчёт" class="btn btn-danger btn-detail btn-sm open_modal" data-toggle="tooltip" value="{{$user->id}}">
                            <i class="fas fa-calendar-plus">
                            </i>
                          </button>
                          </form>
                     @endif
                     @else
                     {{-- <span class="text-dark">Не Сдан</span> --}}
                     <form
                          action="{{ route('reports.create', $user->id)}}" class="d-inline">
                          <button title="Создать отчёт" class="btn btn-danger btn-detail btn-sm open_modal" data-toggle="tooltip" value="{{$user->id}}">
                            <i class="fas fa-calendar-plus">
                            </i>
                          </button>
                          </form>
                        
                @endif
                </th>
                <th class="project-actions text-center">
                    {{-- <form action="{{ route('verify.update', $verified['id']) }}" method="POST" --}}
                    <form action="{{ route('staff.list.index', $user->id) }}"
                        style="display: inline-block">
                        
                        <button type="submit" class="btn btn-secondary btn-sm delete-btn">
                          Отчёты
                          {{-- <i class="far fa-eye">

                          </i> --}}
                        </button>
                    </form>
                </th>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      </div> <!-- /.row-->
  </div>


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
    {{-- <button type="button" class="btn btn-warning" id="btn-save" value="update">Сохранить изменения</button> --}}
    <input type="hidden" id="user_id" name="user_id" value="">
  </div>
</div>

@endsection