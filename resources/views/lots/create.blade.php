@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <h3 class="page__heading">Nuevo registro</h3>
                <ul style="background-color: #ffffff" class="breadcrumb breadcrumb-transparent breadcrumb-dot my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lots.index') }}">Lotes</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="">Nuevo registro</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(array('route' => 'lots.store','method'=>'POST', ' enctype' => 'multipart/form-data')) !!}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">N° Lote</label>
                                            <p>{{$lot->N_Lote}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">Fecha elaboración</label>
                                            <p>{{$lot->N_FechaElaboracion}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">Tipo de proceso</label>
                                            <p>{{$lot->N_TipoProceso}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">Empresa</label>
                                            <p>{{$lot->N_Empresa}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">Proveedor</label>
                                            <p>{{$lot->N_Proveedor}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">Guía de despacho</label>
                                            <p>{{$lot->N_GuiaDespacho}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">N° Cajas</label>
                                            <p>{{$lot->N_Cajas}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">N° Piezas</label>
                                            <p>{{$lot->N_Piezas}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="name">KG Proceso</label>
                                            <p>{{number_format($lot->N_KgProceso, 2, '.', '')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <input type="hidden" name="lot_id" value="{{$lot->IdLote}}">
                                        <div class="form-group">
                                            <label for="name">Guias disponibles</label>
                                            <select class="form-control" id="dispatch_guide_id" name="dispatch_guide_id">
                                                <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                @foreach($dispatchguides as $dispatchguide)
                                                    @if(old('dispatch_guide_id') == $dispatchguide->id)
                                                        <option value="{{$dispatchguide->id}}" selected>{{$dispatchguide->number}}</option>
                                                    @else
                                                        <option value="{{$dispatchguide->id}}">{{$dispatchguide->number}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('dispatch_guide_id'))
                                                <div class="mt-3">
                                                 <span class="text-danger text-left mt-3">
                                                      {{ $errors->first('dispatch_guide_id') }}
                                                 </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <label for="name">KG</label>
                                            <input type="text" class="form-control" id="kg"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <label for="name">KG Bines</label>
                                            <input type="text" class="form-control" id="kg_bins"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <label for="name">KG Cajas</label>
                                            <input type="text" class="form-control" id="kg_boxes"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <label for="name">KG Total</label>
                                            <input type="text" class="form-control" id="kg_total"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <label for="name">Stock</label>
                                            <input type="text" class="form-control" id="kg_stock"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-none" id="msg_error">
                                        <p class="alert-danger p-3 text-center"><i class="fa fa-exclamation-triangle"></i> SE HA SUPERADO LA CARGA DE STOCK SEGÚN PRODUCTOS INGRESADOS EN LA GUÍA</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Tipo de carga</label>
                                            <select class="form-control" id="quantity_type_id" name="quantity_type_id">
                                                <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                @foreach($quantitytypes as $quantitytype)
                                                    @if(old('quantity_type_id') == $quantitytype->id)
                                                        <option value="{{$quantitytype->id}}" selected>{{$quantitytype->name}}</option>
                                                    @else
                                                        <option value="{{$quantitytype->id}}">{{$quantitytype->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('quantity_type_id'))
                                                <div class="mt-3">
                                                 <span class="text-danger text-left mt-3">
                                                      {{ $errors->first('quantity_type_id') }}
                                                 </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Items</label>
                                            <textarea class="form-control" rows="10" style="height: 350px;"
                                                      name="items" id="items"></textarea>
                                            @if ($errors->has('items'))
                                                <div class="mt-3">
                                                 <span class="text-danger text-left mt-3">
                                                      {{ $errors->first('items') }}
                                                 </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button class="btn btn-primary" type="submit" id="btn_send"><i class="fa fa-upload"></i> Cargar</button>
                                    </div>

                                </div>
                            </div>
                            {!! Form::close() !!}
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

            let dispatchGuideId = $('#dispatch_guide_id option:selected').val();

            if(dispatchGuideId !==""){
                $.ajax({
                    url: "/api/dispatchguides/"+$('#dispatch_guide_id option:selected').val(),
                    type: "GET",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#kg").val('Espere...');
                        $("#kg_bins").val('Espere...');
                        $("#kg_boxes").val('Espere...');
                        $("#kg_total").val('Espere...');
                        $("#kg_stock").val('Espere...');
                    },
                    success: function (response) {
                        $("#kg").val(response.data.kg);
                        $("#kg_bins").val(response.data.kgBins);
                        $("#kg_boxes").val(response.data.kgBoxes);
                        $("#kg_total").val(response.data.sumKgTotal);
                        $("#kg_stock").val(response.data.stock);
                    },
                });
            }

            $( "#dispatch_guide_id" ).change(function() {
                $("#msg_error").removeClass('d-block');
                $("#msg_error").addClass('d-none');
                $('#quantity_type_id').prop('disabled', false);
                $('#items').prop('disabled', false);
                $('#btn_send').prop('disabled', false);
                $.ajax({
                    url: "/api/dispatchguides/"+$( this ).val(),
                    type: "GET",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#kg").val('Espere...');
                        $("#kg_bins").val('Espere...');
                        $("#kg_boxes").val('Espere...');
                        $("#kg_total").val('Espere...');
                        $("#kg_stock").val('Espere...');
                    },
                    success: function (response) {
                        $("#kg").val(response.data.kg);
                        $("#kg_bins").val(response.data.kgBins);
                        $("#kg_boxes").val(response.data.kgBoxes);
                        $("#kg_total").val(response.data.sumKgTotal);
                        $("#kg_stock").val(response.data.stock);

                        if(response.data.stock <= 0){
                            $("#msg_error").removeClass('d-none');
                            $("#msg_error").addClass('d-block');
                            $('#quantity_type_id').prop('disabled', true);
                            $('#items').prop('disabled', true);
                            $('#btn_send').prop('disabled', true);
                        }
                    },
                });
            });
        });
    </script>
@endpush
