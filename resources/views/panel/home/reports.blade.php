@extends('layouts.panel_layout')

@section('title', 'Отчёты')
@section('content')

    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
      <div class=" text-center pt-5 ">
      <h1>Список отчётов</h1>
  </div>
  <div class="align-items-center mt-5 m-3 d-flex justify-content-center ">
    <div class="table-responsive w-75">
        <table class="table table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th class="text-center"><strong>Дата</strong></th>
              <th class="text-center"><strong>Имя</strong></th>
              <th class="text-center"><strong>Фамилия</strong></th>
              <th class="text-center"><strong>Действия</strong></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              
            </tr>
          </tbody>
        </table>
      </div>
      </div> <!-- /.row-->
  </div>
</div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  @endsection