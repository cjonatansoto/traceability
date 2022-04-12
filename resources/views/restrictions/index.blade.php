@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Restricciones de mercado</h3>
        </div>
        <div class="section-body">
            <div class="row">
                @include('sweetalert::alert')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{route('restrictions.create')}}"><i class="fa fa-plus-circle"></i> Nuevo registro</a>
                            <br/>
                            <br/>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef">
                                <tr>
                                    <th style="color:#fff;">#ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Codigo</th>
                                    <th style="color:#fff;">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($restrictions as $restriction)
                                    <tr>
                                        <td>{{$restriction->id}}</td>
                                        <td>{{$restriction->name}}</td>
                                        <td>{{$restriction->code}}</td>
                                        <td>
                                            <a href="{{ route('restrictions.edit',$restriction->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
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
