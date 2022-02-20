@extends('layouts.panel_layout')

@section('title', 'Список отчётов')
@section('content')

<section class="content">
  <div class="container">
    <div class=" text-center pt-5 ">
    <h1>Список сотрудников</h1>
  </div>
  {{-- <div class="container text-center mt-5" style="max-width: 450px">
    <label for="unsumbitted-dates" class="col-sm-12  control-label" >Фильтрация по сдаче отчёта за определенный день</label>
    <input class="form-control" name="unsumbitted-dates" />
    <input id="start" name="start" type="hidden"/>
    <input id="end" name="end" type="hidden"/>
  </div> --}}
  <div class="mx-auto text-center mt-5">
    <label>Фильтрация по должности:</label>
    <select  class="form-control w-25 mx-auto role-selector" id="role" name="role" placeholder="Роль" >
      <option value='2'>Рабочие</option>
      <option value="3">Менеджеры</option>
      <option value="4">Администраторы</option>
    </select>
  </div>
  <div class="align-items-center mt-5 m-1 d-flex justify-content-center ">
    <div class="table-responsive w-75">
      <table class="table table-striped table-hover table-condensed">
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
              @if ($user->role_id == 1)
                  @continue
              @endif
              <tr class="staff-row text-center">
                <input type="hidden" name="role_id" value={{$user->role_id}} />
                <th class="staff-id">{{$user->id}}</th>
                <th>{{$user->name}}</th>
                <th>{{$user->email}}</th>
                <th>{{count($user->reports)}}</th>
                <th class="staff-buttons text-center d-flex justify-content-center">
                  <!-- Check if user has any reports -->
                    @if (!empty($user->reports->sortByDesc('created_at')->first()))
                      <!-- Check if user submitted report for today -->
                      @if ($user->reports->sortByDesc('created_at')->first()->created_at->toDateString() == \Carbon\Carbon::now()->toDateString())
                      <button name="check-report" title="Посмотреть отчёт" class="btn btn-info btn-detail btn-sm btn_add open_modal_report m-2" data-toggle="tooltip" value="{{$user->reports->sortByDesc('created_at')->first()->id}}">
                        <i class="fas fa-eye">
                        </i>
                      </button>
                      <form
                      action="{{ route('reports.edit', $user->reports->sortByDesc('created_at')->first()->id) }}" class="d-inline">
                        <button name="edit-report" title="Редактировать отчёт" class="btn btn-info btn-detail btn-sm m-2" data-toggle="tooltip" value="{{$user->id}}">
                          <i class="fas fa-pencil-alt">
                          </i>
                        </button>
                      </form>
                      @else
                      <!-- No report for today from user -->
                      <button title="Создать отчёт" class="btn btn-danger btn-detail btn-sm open_modal_create" data-toggle="tooltip" value="{{$user->id}}">
                        <i class="fas fa-calendar-plus">
                        </i>
                      </button>
                        @endif
                      @else
                      <!-- No reports from user at all -->
                      <button title="Создать отчёт" class="btn btn-danger btn-detail btn-sm open_modal_create" data-toggle="tooltip" value="{{$user->id}}">
                        <i class="fas fa-calendar-plus">
                        </i>
                      </button>
                      @endif
              </th>
              <th class="project-actions  text-center">
                  <form action="{{ route('staff.list', $user->id) }}"
                      style="display: inline-block">
                      <button type="submit" class="btn btn-secondary btn-sm delete-btn">
                        Отчёты
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
</section>

  <input id="url" type="hidden" value="{{ \Request::url() }}">
 <!-- Show modal -->
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