@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Neppex</h3>
        </div>
        <div class="section-body">
            <div class="row">
                @include('sweetalert::alert')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{route('neppex.create')}}"><i class="fa fa-plus-circle"></i> Nuevo registro</a>
                            <a class="btn btn-primary" href="{{route('neppex.filteredout')}}"><i class="fa fa-search"></i> Filtrar</a>
                            <a class="btn btn-primary" href="{{route('neppex.filteredoutbox')}}"><i class="fa fa-search"></i> Filtrar Cajas</a>
                            <br/>
                            <br/>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef">
                                <tr>
                                    <th style="color:#fff;">#ID</th>
                                    <th style="color:#fff;">Codaut</th>
                                    <th style="color:#fff;">Codigo de traspaso</th>
                                    <th style="color:#fff;">Fecha de Autorización</th>
                                    <th style="color:#fff;">Fecha carga</th>
                                    <th style="color:#fff;">Responsable</th>
                                    <th style="color:#fff;">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($neppexs as $neppex)
                                        <tr>
                                            <td>{{$neppex->id}}</td>
                                            <td>{{$neppex->codaut}}</td>
                                            <td>{{$neppex->transfer_code}}</td>
                                            <td>{{date('d-m-Y',strtotime($neppex->authorization_date))}}</td>
                                            <td>{{date('d-m-Y H:i',strtotime($neppex->updated_at))}}</td>
                                            <td>{{$neppex->updatedBy->name}}</td>
                                            <td>
                                                <form action="{{ route('neppex.destroy', $neppex) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('neppex.excel', $neppex->codaut) }}"
                                                           style="width: 40px"
                                                           class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Exportar Neppex"><i class="fa fa-file-excel"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger" style="width: 40px" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar Neppex">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Codaut</th>
                                    <th>Fecha de Autorización</th>
                                    <th>Responsable</th>
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
