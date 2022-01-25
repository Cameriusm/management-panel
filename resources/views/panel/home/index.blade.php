@extends('layouts.panel_layout')

@section('title', 'Главная')
@section('content')

    <section class="content">
      <div class="container-fluid ">
        <!-- Small boxes (Stat box) -->
        <div class="row d-flex justify-content-center pt-5">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$userSubmitted->count()}}</h3>
                <p>Сотрудников сдали отчёт сегодня</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
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
                        <td class="project-actions text-right">
                          <button class="btn btn-info btn-detail btn-sm open_modal" value="{{$user->id}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Просмотреть
                          </button>
                      </tr>            
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div>

          </div>
          {{-- @if(Auth::user->hasRole('admin'))
   // show content related to it
   KKLKLKLK 
   @endif  --}}
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                {{-- <h3>{{$reportCount}}<sup style="font-size: 20px">%</sup></h3> --}}
                <h3>{{$userUnsubmitted->count()}}</h3>

                <p>Сотрудников не сдали отчёт сегодня</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
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
                        <td class="project-actions text-right">
                          <button class="btn btn-success btn-sm open_modal" value="{{$user->id}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Просмотреть
                          </button>
                      </tr>            
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection