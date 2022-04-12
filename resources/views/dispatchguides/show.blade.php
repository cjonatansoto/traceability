@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <h3 class="page__heading">Visualizar registro</h3>
                <ul style="background-color: #ffffff" class="breadcrumb breadcrumb-transparent breadcrumb-dot my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dispatchguides.index') }}">Guías de despacho</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="">Visualizar registro</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="sendEditDispatchGuide">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <a href="{{route('dispatchguides.edit', $dispatchguide->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a>
                                            @if($dispatchguide->dispatchGuideType->visible == 1)
                                                <a href="{{route('dispatchguides.redirect', ['generalbackground', $dispatchguide])}}" class="btn btn-primary">Antecedentes generales <span>{{$countGeneralBackground}}</span></a>
                                                <a href="{{route('dispatchguides.redirect', ['analysisresults', $dispatchguide])}}" class="btn btn-primary">Resultados de analisis <span>{{$countAnalysisResults}}</span></a>
                                                <a href="{{route('dispatchguides.redirect', ['forbiddensubstances', $dispatchguide])}}" class="btn btn-primary">Sustancias prohibidas <span>{{$countForbiddenSubstance}}</span></a>
                                                <a href="{{route('dispatchguides.redirect', ['marketrestrictions', $dispatchguide])}}" class="btn btn-primary">Restricciones de mercado <span>{{$countMarketRestriction}}</span></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tipo de ingreso</label>
                                                <p>{{$dispatchguide->dispatchGuideType->name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="name">Numero de guía</label>
                                                <p>{{$dispatchguide->number}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fecha/Hora ingreso planta</label>
                                                <p>{{date('d-m-Y H:i', strtotime($dispatchguide->plant_entry_date))}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fecha de guia</label>
                                                <p>{{date('d-m-Y', strtotime($dispatchguide->date_physical_guide))}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fecha de cierre</label>
                                                <p>{{date('d-m-Y', strtotime($dispatchguide->target_date))}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <p>{{$dispatchguide->enterprise->descripcion}}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Proveedor</label>
                                                <p>{{$dispatchguide->provider->descripcion}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-0">
                                                <label>Items de guia</label>
                                            </div>
                                            <table class="table table-striped table-bordered" style="width:100%" id="items">
                                                <thead style="background-color:#6777ef">
                                                <tr>
                                                    <th style="color:#fff;">Tipo de cantidad</th>
                                                    <th style="color:#fff;">Cantidad</th>
                                                    <th style="color:#fff;">Piezas</th>
                                                    <th style="color:#fff;">KGs</th>
                                                    <th style="color:#fff;">Especie</th>
                                                    <th style="color:#fff;">Corte</th>
                                                    <th style="color:#fff;">Conservación</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($dispatchguideitems as $items)
                                                    <tr>
                                                        <td> {{$items->quantityType->name}}</td>
                                                        <td> {{$items->amount}}</td>
                                                        <td> {{$items->pieces}}</td>
                                                        <td> {{$items->kgs}}</td>
                                                        <td> {{$items->species->descripcion}}</td>
                                                        <td> {{$items->court->nombre}}</td>
                                                        <td> {{$items->preservation->nombre}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="comment">Observación</label>
                                                <p>{{$dispatchguide->observations}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Guia de respaldo</label>
                                                <a href="{{asset($dispatchguide->file)}}" download=""><i class="fa fa-download"></i> Descargar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
