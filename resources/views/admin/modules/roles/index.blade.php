@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Roles</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Ticket</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
          <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Crear</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Titulo</th>
                  <th>Descripción</th>
                  <th>Especial</th>
                  <th>Creación</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Titulo</th>
                  <th>Descripción</th>
                  <th>Especial</th>
                  <th>Creación</th>
                  <th>Opciones</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($roles as $rol)
                <tr>
                    <td>{{ $rol->name }}</td>
                    <td>{{ $rol->description }}</td>
                    <td>{{ $rol->special }}</td>
                    <td>{{ $rol->created_at }}</td>
                    <td>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-success btn-sm">
                              <input type="radio" name="options" id="option1" autocomplete="off"> Editar
                            </label>
                            <label class="btn btn-warning btn-sm">
                              <input type="radio" name="options" id="option2" autocomplete="off"> Suspender
                            </label>
                            <label class="btn btn-danger btn-sm">
                              <input type="radio" name="options" id="option3" autocomplete="off"> Eliminar
                            </label>
                          </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->
  </div>

@endsection
