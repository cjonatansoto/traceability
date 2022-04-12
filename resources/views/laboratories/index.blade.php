@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Laboratorios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                @include('sweetalert::alert')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{route('laboratories.create')}}"><i class="fa fa-plus-circle"></i> Nuevo registro</a>
                            <br/>
                            <br/>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef">
                                <tr>
                                    <th style="color:#fff;">#ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Rut</th>
                                    <th style="color:#fff;">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($laboratories as $laboratory)
                                    <tr>
                                        <td>{{$laboratory->id}}</td>
                                        <td>{{$laboratory->name}}</td>
                                        <td>{{$laboratory->rut}}</td>
                                        <td>
                                            <a href="{{ route('laboratories.edit',$laboratory->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nombre</th>
                                    <th>Rut</th>
                                    <th>Acciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
