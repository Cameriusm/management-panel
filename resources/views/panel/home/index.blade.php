@extends('layouts.panel_layout')

@section('title', 'Главная')
@section('content')
<section class="content">
  <div class="container-fluid ">
    <div class="d-flex justify-content-center">
     
    </div>
    <!-- Small boxes (Stat box) -->
    <div class="row d-flex justify-content-center pt-3">
      <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-info text-center">
          <div class="inner">
            <h3>{{$userSubmitted->count()}}</h3>
            <p>Сотрудников сдали отчёт</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar-plus"></i>
          </div>
          <a href="{{ route('reports.index') }}"  class="small-box-footer">Список отчётов</a>
        </div>
        <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
          <div class="table-responsive w-100">
              <table class="table table-striped table-hover table-condensed">
                <thead>
                  <tr>
                    <th class="text-center"><strong>№</strong></th>
                    <th class="text-center"><strong>Имя</strong></th>
                    <th class="text-center"><strong>Почта</strong></th>
                    <th class="text-center"><strong>Роль</strong></th>
                    <th class="text-center"><strong>Действия</strong></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($userSubmitted as $user)
                  <tr ">
                    <th class="text-center">{{$user->id}}</th>
                    <th class="text-center">{{$user->name}}</th>
                    <th class="text-center">{{$user->email}}</th>
                    <th class="text-center">
                      @switch($user->role_id)
                        @case(1)
                            <p>Гость</p>
                        @break
                        @case(2)
                            <p>Работник</p>
                        @break
                        @case(3)
                            <p>Менеджер</p>
                        @break
                        @case(4)
                            <p>Администратор</p>
                        @break
                        @default
                            <p>¯\_(ツ)_/¯</p> 
                      @endswitch
                    </th>
                    <th class="project-actions text-center">
                      <button title="Посмотреть отчёт" class="btn btn-info btn-detail btn-sm btn_add open_modal_report" data-toggle="tooltip" value="{{$user->reports->sortByDesc('created_at')->first()->id}}">
                        <i class="fas fa-eye">
                        </i>
                      </button>
                      <form
                      action="{{ route('reports.edit', $user->reports->sortByDesc('created_at')->first()->id)}}" class="d-inline">
                      <button title="Редактировать отчёт" class="btn btn-info btn-detail btn-sm open_modal" data-toggle="tooltip" value="{{$user->id}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                      </button>
                      </form>
                      <form
                      action="{{ route('staff.list', $user->id)}}" class="d-inline">
                      <button title="Все отчёты" class="btn btn-info btn-detail btn-sm open_modal" data-toggle="tooltip" value="{{$user->id}}">
                        <i class="fas fa-table">
                        </i>
                      </button>
                    </form>
                    </th>
                  </tr>            
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-danger  text-center">
          <div class="inner">
            <h3>{{$userUnsubmitted->count()}}</h3>
            <p>Сотрудников не сдали отчёт</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar-minus"></i>
          </div>
          <a href="{{ route('staff') }}" class="small-box-footer">Список сотрудников</a>
        </div>
        <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
          <div class="table-responsive w-100">
              <table class="table table-striped table-hover table-condensed">
                <thead>
                  <tr>
                    <th class="text-center"><strong>№</strong></th>
                    <th class="text-center"><strong>Имя</strong></th>
                    <th class="text-center"><strong>Почта</strong></th>
                    <th class="text-center"><strong>Роль</strong></th>
                    <th class="text-center"><strong>Действия</strong></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($userUnsubmitted as $user)
                    @if ($user->role_id == 1)
                     @continue
                   @endif
                  <tr ">
                    <th class="text-center">{{$user->id}}</th>
                    <th class="text-center">{{$user->name}}</th>
                    <th class="text-center">{{$user->email}}</th>
                    <th class="text-center"> 
                      @switch($user->role_id)
                        @case(1)
                            <p>Гость</p>
                        @break
                        @case(2)
                            <p>Работник</p>
                        @break
                        @case(3)
                            <p>Менеджер</p>
                        @break
                        @case(4)
                            <p>Администратор</p>
                        @break
                        @default
                            <p>¯\_(ツ)_/¯</p> 
                      @endswitch</th>
                    <th class="project-actions text-center ">
                      
                      <button title="Создать отчёт" class="btn btn-danger btn-detail btn-sm open_modal_create" data-toggle="tooltip" value="{{$user->id}}">
                        <i class="fas fa-calendar-plus">
                        </i>
                      </button>
                      <form
                      action="{{ route('staff.list', $user->id)}}" class="d-inline">
                      <button title="Все отчёты " class="btn btn-danger btn-sm open_modal" data-toggle="tooltip" value="{{$user->id}}">
                        <i  class="fas fa-table">
                        </i>
                    </button>
                      </form>
                  </tr>            
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  

  <input id="url" type="hidden" value="{{ \Request::url() }}">
<!-- Show modal -->
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