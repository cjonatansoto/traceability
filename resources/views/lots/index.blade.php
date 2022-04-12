@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <h3 class="page__heading">Lotes</h3>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Años</label>
                                            <select class="form-control" id="year">
                                                @foreach($years as &$year)
                                                    @if(date("Y", strtotime(now())) == $year)
                                                        <option value="{{$year}}" selected>{{$year}}</option>
                                                    @else
                                                        <option value="{{$year}}">{{$year}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Meses</label>
                                            <select class="form-control" id="month">
                                                <option value="ALL" selected>TODOS</option>
                                                @foreach($months as &$month)
                                                    <option value="{{$month}}">{{mb_strtoupper($month)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <select class="form-control" id="provider">
                                                <option value="ALL" selected>TODOS</option>
                                                @foreach($providers as $provider)
                                                    <option value="{{$provider->descripcion}}">{{mb_strtoupper($provider->descripcion)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Empresas</label>
                                            <select class="form-control" id="enterprise">
                                                <option value="ALL" selected>TODOS</option>
                                                @foreach($enterprises as $enterprise)
                                                    <option value="{{$enterprise->descripcion}}">{{mb_strtoupper($enterprise->descripcion)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" id="status">
                                                <option selected value="0">ABIERTO</option>
                                                <option value="1">CERRADO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <table class="table table-striped table-bordered" style="width:100%" id="table_lots">
                                            <thead style="background-color:#6777ef">
                                            <tr>
                                                <th style="color:#fff;">#ID</th>
                                                <th style="color:#fff;">N° Lote</th>
                                                <th style="color:#fff;">Fecha elaboración</th>
                                                <th style="color:#fff;">Tipo de proceso</th>
                                                <th style="color:#fff;">Empresa</th>
                                                <th style="color:#fff;">Proveedor</th>
                                                <th style="color:#fff;">Guía de despacho</th>
                                                <th style="color:#fff;">N° Cajas</th>
                                                <th style="color:#fff;">N° Piezas</th>
                                                <th style="color:#fff;">KG Proceso</th>
                                                <th style="color:#fff;">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#table_lots').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                searching: false,
                ajax: {
                    url: "{{ route('lots.list') }}",
                    data: function (d) {
                                d.filterStatus = $('#status').val(),
                                d.filterEnterprise = $('#enterprise').val(),
                                d.filterProvider = $('#provider').val(),
                                d.filterMonth = $('#month').val(),
                                d.filterYear = $('#year').val()
                    }
                },
                dataType: 'json',
                type: "POST",
                columns: [
                    {
                        data: 'IdLote',
                        name: 'IdLote',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_Lote',
                        name: 'N_Lote',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_FechaElaboracion',
                        name: 'N_FechaElaboracion',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_TipoProceso',
                        name: 'N_TipoProceso',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_Empresa',
                        name: 'N_Empresa',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_Proveedor',
                        name: 'N_Proveedor',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_GuiaDespacho',
                        name: 'N_GuiaDespacho',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_Cajas',
                        name: 'N_Cajas',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_Piezas',
                        name: 'N_Piezas',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'N_KgProceso',
                        name: 'N_KgProceso',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false
                    }
                ],
            })

            $('#year').change(function(){
                table.draw();
            });

            $('#month').change(function(){
                table.draw();
            });

            $('#provider').change(function(){
                table.draw();
            });

            $('#enterprise').change(function(){
                table.draw();
            });

            $('#status').change(function(){
                table.draw();
            });

        })
    </script>
@endpush
