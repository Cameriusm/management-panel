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
                      Сдан
                    @else
                      Не сдан
                    @endif
                @else
                      Не сдан
                @endif
                </th>
                <th class="project-actions text-center">
                    {{-- <form action="{{ route('verify.update', $verified['id']) }}" method="POST" --}}
                    <form action="{{ route('staff.list.index', $user->id) }}"
                        style="display: inline-block">
                        
                        <button type="submit" class="btn btn-info btn-sm delete-btn">
                            <i class="fas fa-pencil-alt">
                            </i>
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
@endsection