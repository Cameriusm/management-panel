@extends('layouts.panel_layout')

@section('title', 'Подтверждение')
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
      <h1>Подтверждение пользователей</h1>
    </div>
    <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
      <div class="table-responsive w-75">
          <table class="table table-striped table-hover table-condensed">
            <thead>
              <tr>
                <th class="text-center"><strong>№</strong></th>
                <th class="text-center"><strong>Имя</strong></th>
                <th class="text-center"><strong>Фамилия</strong></th>
                <th class="text-center"><strong>Дата создания</strong></th>
                <th class="text-center"><strong>Действия</strong></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($verifieds as $verified)
              <tr>
                <th>{{$verified->id}}</th>
                <th>{{$verified->name}}</th>
                <th>{{$verified->email}}</th>
                <th>{{$verified->created_at}}</th>
                {{-- <th>{{$verified->role_id}}</th> --}}
                <td class="project-actions text-right">
                  {{-- <a class="btn btn-info btn-sm" href="#"> --}}
                  {{-- <a class="btn btn-info btn-sm" href="{{ route('post.edit', $post['id']) }}"> --}}
                      {{-- <i class="fas fa-pencil-alt">
                      </i>
                      Подтвердить
                  </a> --}}
                  <form action="{{ route('verify.update', $verified['id']) }}" method="POST"
                  {{-- <form action="#" method="POST" --}}
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

    <!-- /.content -->

  <!-- /.content-wrapper -->
@endsection