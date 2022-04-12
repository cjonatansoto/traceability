@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Guías de despacho</h3>
        </div>
        <div class="section-body">
            <div class="row">
                @include('sweetalert::alert')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{route('dispatchguides.create')}}"><i class="fa fa-plus-circle"></i> Nuevo registro</a>
                            <br/>
                            <br/>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef">
                                <tr>
                                    <th style="color:#fff;">Tipo de ingreso</th>
                                    <th style="color:#fff;">Numero de guía</th>
                                    <th style="color:#fff;">Fecha de guía</th>
                                    <th style="color:#fff;">Empresa</th>
                                    <th style="color:#fff;">Proveedor</th>
                                    <th style="color:#fff;">Usuario</th>
                                    <th style="color:#fff;">Estado</th>
                                    <th style="color:#fff;">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dispatchguides as $dispatchguide)
                                    <tr class="{{$dispatchguide->status}}">
                                        <td>{{$dispatchguide->dispatchGuideType->name}}</td>
                                        <td>{{$dispatchguide->number}}</td>
                                        <td>{{date('d-m-Y', strtotime($dispatchguide->date_physical_guide))}}</td>
                                        <td>{{$dispatchguide->enterprise->descripcion}}</td>
                                        <td>{{$dispatchguide->provider->descripcion}}</td>
                                        <td>{{$dispatchguide->updatedBy->name}}</td>
                                        <td>
                                            @if($dispatchguide->dispatchGuideType->name === "PROCESO" )
                                            @foreach($dispatchguide->count as $row)
                                            <li>{{$row}}</li>
                                            @endforeach
                                            @else
                                                No Aplica
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('dispatchguides.destroy', $dispatchguide) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('dispatchguides.show',$dispatchguide) }}"
                                                       class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver guía de despacho"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('dispatchguides.edit',$dispatchguide->id) }}"
                                                       class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar guía de despacho"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar guía de despacho">
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
                                    <th>Tipo de ingreso</th>
                                    <th>Numero de guía</th>
                                    <th>Fecha de guía</th>
                                    <th>Empresa</th>
                                    <th>Proveedor</th>
                                    <th>Usuario</th>
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
