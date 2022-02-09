@extends('layouts.panel_layout')

@section('title', 'Подтверждение')
@section('content')

<section class="content">
    <div class="container">
      <div class=" text-center pt-5 ">
      <h1>Подтверждение пользователей</h1>
    </div>
    <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
      <div class="table-responsive w-75">
          <table class="table table-striped table-hover table-condensed">
            <thead>
              <tr>
                <th class="text-center"><strong>№</strong></th>
                <th class="text-center"><strong>Имя</strong></th>
                <th class="text-center"><strong>Почта</strong></th>
                <th class="text-center"><strong>Дата создания</strong></th>
                <th class="text-center"><strong>Действия</strong></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($verified as $user)
              <tr>
                <th class="text-center">{{$user->id}}</th>
                <th class="text-center">{{$user->name}}</th>
                <th class="text-center">{{$user->email}}</th>
                <th class="text-center">{{$user->created_at}}</th>
                <td class="project-actions text-center">
                  <form action="{{ route('verify.update', $user['id']) }}" method="POST"
                      style="display: inline-block">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="btn btn-info btn-sm delete-btn">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Подтвердить
                      </button>
                  </form>
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        </div> <!-- /.row-->
    </div>
  </div>
</div><!-- /.container-fluid -->
</section>
@endsection