@extends('layouts.panel_layout')

@section('title', 'Изменение прав')
@section('content')

    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
      <div class=" text-center pt-5 ">
      <h1>Изменение прав пользователей</h1>
    </div>
    <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
      <div class="table-responsive w-75">
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
              @foreach ($rights as $right)
              <tr ">
                <th class="text-center">{{$right->id}}</th>
                <th class="text-center">{{$right->name}}</th>
                <th class="text-center">{{$right->email}}</th>
                <th class="text-center" id="th-{{$right->id}}">
                  @switch($right->role_id)
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
                <td class="project-actions text-right">
                  <button class="btn btn-warning btn-detail btn-sm open_modal" value="{{$right->id}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Редактировать
                  </button>
                  {{-- <form action="#" method="POST"
                      style="display: inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm delete-btn">
                          <i class="fas fa-trash">
                          </i>
                          Удалить
                      </button>
                  </form> --}}
              </td>
              </tr>
                  
              @endforeach

              <!-- Passing BASE URL to AJAX -->
              <input id="url" type="hidden" value="{{ \Request::url() }}">
                    <!-- MODAL SECTION -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Изменение прав</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                      <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group error">
                          <label for="inputName" class="col-sm-3 control-label" >Имя</label>
                          <div class="col-sm-9">
                            <input readonly type="text" class="form-control has-error" id="name" name="name" placeholder="Product Name" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputDetail" class="col-sm-3 control-label">Почта</label>
                          <div class="col-sm-9">
                            <input readonly type="email" class="form-control" id="email" name="email" placeholder="Email" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputDetail" class="col-sm-3 control-label">Роль</label>
                          <div class="col-sm-9">
                            <select  class="form-control" id="role" name="role" placeholder="Роль" >
                                        <option value="1">Гость</option>
                                        <option value='2'>Рабочий</option>
                                        <option value="3">Менеджер</option>
                                        <option value="4">Администратор</option>
                                      </select>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" id="btn-save" value="update">Сохранить изменения</button>
                      <input type="hidden" id="user_id" name="user_id" value="">
                    </div>
                  </div>
                </div>
              </div>
            </tbody>
          </table>
        </div>
        </div> <!-- /.row-->
    </div>
  </div><!-- /.container-fluid -->

    <!-- /.content -->

  <!-- /.content-wrapper -->
  @endsection