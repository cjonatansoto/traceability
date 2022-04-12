@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <h3 class="page__heading">Nuevo registro</h3>
                <ul style="background-color: #ffffff" class="breadcrumb breadcrumb-transparent breadcrumb-dot my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dispatchguides.index') }}">Guías de despacho</a>
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
                            <form id="sendDispatchGuide">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tipo de ingreso</label>
                                                <select class="form-control" id="dispatch_guide_type_id">
                                                    <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                    @foreach($dispatchguidetypes as $dispatchguidetype)
                                                        @if(old('dispatch_guide_type_id') == $dispatchguidetype->id)
                                                            <option value="{{$dispatchguidetype->id}}" selected>{{$dispatchguidetype->name}}</option>
                                                        @endif
                                                        <option value="{{$dispatchguidetype->id}}">{{$dispatchguidetype->name}}</option>
                                                    @endforeach
                                                </select>
                                                <label id="dispatch_guide_type_id-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="name">Numero de guía</label>
                                                <input type="text" class="form-control" id="number" onkeypress="return valideKey(event);">
                                                <label id="number-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fecha/Hora ingreso planta</label>
                                                <input type="datetime-local" class="form-control" id="plant_entry_date" max="{{ date('Y-m-d\TH:i') }}">
                                                <label id="plant_entry_date-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fecha de guia</label>
                                                <input type="date" class="form-control" id="date_physical_guide" max="{{ now()->toDateString('Y-m-d') }}">
                                                <label id="date_physical_guide-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fecha de cierre</label>
                                                <input type="date" class="form-control" id="target_date" max="{{date('Y-m-d', strtotime(' + 30 days'))}}">
                                                <label id="target_date-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <select class="form-control select2" id="enterprise_id">
                                                    <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                    @foreach($enterprises as $enterprise)
                                                        @if(old('enterprise_id') == $enterprise->cod_empresa)
                                                            <option value="{{$enterprise->cod_empresa}}" selected>{{$enterprise->descripcion}}</option>
                                                        @endif
                                                        <option value="{{$enterprise->cod_empresa}}">{{$enterprise->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                                <label id="enterprise_id-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Proveedor</label>
                                                <select class="form-control select2" id="provider_id">
                                                    <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                    @foreach($providers as $provider)
                                                        @if(old('provider_id') == $provider->cod_proveedor)
                                                            <option value="{{$provider->cod_proveedor}}" selected>{{$provider->descripcion}}</option>
                                                        @endif
                                                        <option value="{{$provider->cod_proveedor}}">{{$provider->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                                <label id="provider_id-error" class="error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tipo de cantidad</label>
                                                    <select class="form-control"
                                                            id="quantity_type_id">
                                                        <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                        @foreach($quantitytypes as $quantitytype)
                                                            @if(old('quantity_type_id') == $quantitytype->id)
                                                                <option value="{{$quantitytype->id}}"
                                                                        selected>{{$quantitytype->name}}</option>
                                                            @endif
                                                            <option
                                                                value="{{$quantitytype->id}}">{{$quantitytype->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label id="quantity_type_id-error" class="error"
                                                           for="quantity_type_id"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Cantidad</label>
                                                    <input type="text" class="form-control" id="amount" onkeypress="return valideKey(event);">
                                                    <label id="amount-error" class="error"
                                                           for="amount"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Piezas</label>
                                                    <input type="text" class="form-control" id="pieces" onkeypress="return valideKey(event);">
                                                    <label id="pieces-error" class="error"
                                                           for="pieces"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kilos</label>
                                                    <input type="text" class="form-control"
                                                           id="kgs" onkeypress="return filterFloat(event,this);">
                                                    <label id="kgs-error" class="error"
                                                           for="kgs"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Especies</label>
                                                    <select class="form-control" id="species_id">
                                                        <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                        @foreach($species as $specie)
                                                            @if(old('species_id') == $specie->cod_especie)
                                                                <option value="{{$specie->cod_especie}}"
                                                                        selected>{{$specie->descripcion}}</option>
                                                            @endif
                                                            <option value="{{$specie->cod_especie}}">{{$specie->descripcion}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label id="species_id-error" class="error" for="species_id"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Corte</label>
                                                    <select class="form-control" id="cut_id">
                                                        <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                        @foreach($cuts as $court)
                                                            @if(old('cut_id') == $court->cod_corte)
                                                                <option value="{{$court->cod_corte}}"
                                                                        selected>{{$court->nombre}}</option>
                                                            @endif
                                                            <option value="{{$court->cod_corte}}">{{$court->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label id="cut_id-error" class="error" for="cut_id"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Conservación</label>
                                                    <select class="form-control"
                                                            id="preservation_id">
                                                        <option value="" selected disabled hidden>SELECCIONAR...</option>
                                                        @foreach($preservation as $item)
                                                            @if(old('preservation_id') == $item->cod_cons)
                                                                <option value="{{$item->cod_cons}}"
                                                                        selected>{{$item->nombre}}</option>
                                                            @endif
                                                            <option value="{{$item->cod_cons}}">{{$item->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label id="preservation_id-error" class="error"
                                                           for="preservation_id"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2" style="margin-top: 27px;">
                                                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_add_items">
                                                    <i class="fa fa-plus-circle"></i> Agregar
                                                </button>
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
                                                    <th style="color:#fff;">Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control-file" id="countItems">
                                                <label id="items-error" class="error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="comment">Observación</label>
                                                <textarea class="form-control" rows="5" id="observations" style="height: 100px"></textarea>
                                                <label id="observations-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Guia de respaldo</label>
                                                <input type="file" class="form-control-file" id="file">
                                                <label id="file-error" class="error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" type="submit" id="btnCreate">
                                                Guardar
                                            </button>
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
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {


            $( "#quantity_type_id" ).click(function() {
                if($('#quantity_type_id').val() !== null){
                    $('#quantity_type_id-error').text('');
                }
            });

            $( "#species_id" ).click(function() {
                if($('#species_id').val() !== null){
                    $('#species_id-error').text('');
                }
            });

            $( "#cut_id" ).click(function() {
                if($('#cut_id').val() !== null){
                    $('#cut_id-error').text('');
                }
            });

            $( "#preservation_id" ).click(function() {
                if($('#preservation_id').val() !== null){
                    $('#preservation_id-error').text('');
                }
            });


            $("#btn_add_items").click(function () {

                var errors = false;

                var quantityType = {
                    'id': $('#quantity_type_id').val(),
                    'name': $("#quantity_type_id option:selected").text()
                }

                var amount = $('#amount').val();

                var pieces = $('#pieces').val();

                var kgs = $('#kgs').val();

                var species = {
                    'id': $('#species_id').val(),
                    'name': $("#species_id option:selected").text()
                }
                var cut = {
                    'id': $('#cut_id').val(),
                    'name': $("#cut_id option:selected").text()
                }
                var preservation = {
                    'id': $('#preservation_id').val(),
                    'name': $("#preservation_id option:selected").text()
                }

                if (quantityType.id == null) {
                    errors = true;
                    $('#quantity_type_id-error').text('Este campo es requerido.');
                    $("#quantity_type_id-error").css("display", "block");
                } else {
                    $('#quantity_type_id-error').text('');
                }

                if (amount == '') {
                    errors = true;
                    $('#amount-error').text('Este campo es requerido.');
                    $("#amount-error").css("display", "block");
                } else {
                    if(amount < 0){
                        $('#amount-error').text('valor mayor a cero');
                    }else{
                        $('#amount-error').text('');
                    }
                }

                if (kgs == '') {
                    errors = true;
                    $('#kgs-error').text('Este campo es requerido.')
                    $("#kgs-error").css("display", "block");
                } else {
                    if(kgs < 0){
                        $('#kgs-error').text('valor mayor a cero')
                    }else{
                        $('#kgs-error').text('');
                    }
                }

                if (species.id == null) {
                    errors = true;
                    $('#species_id-error').text('Este campo es requerido.')
                    $("#species_id-error").css("display", "block");
                } else {
                    $('#species_id-error').text('');
                }

                if (cut.id == null) {
                    errors = true;
                    $('#cut_id-error').text('Este campo es requerido.')
                    $("#cut_id-error").css("display", "block");
                } else {
                    $('#cut_id-error').text('');
                }

                if (preservation.id == null) {
                    errors = true;
                    $('#preservation_id-error').text('Este campo es requerido.')
                    $("#preservation_id-error").css("display", "block");
                } else {
                    $('#preservation_id-error').text('');
                }

                if(pieces == '' || pieces == 0){
                    pieces = '0';
                }

                if(errors == false){

                    $('#countItems').val(Number($('#countItems').val()) + 1);

                    var data = {
                        'quantity_type_id' : quantityType.id,
                        'amount' : amount,
                        'pieces' : pieces,
                        'kgs' : kgs,
                        'species_id': species.id,
                        'cut_id': cut.id,
                        'preservation_id': preservation.id
                    }

                    $('#items >tbody').append("<tr quantity_type_id='"+quantityType.id+"' amount='"+amount+"' pieces='"+pieces+"' kgs='"+Number(kgs).toFixed(2)+"' species_id='"+species.id+"'  cut_id='"+cut.id+"' preservation_id='"+preservation.id+"'>" +
                        "<td>" + quantityType.name + "</td>" +
                        "<td>" + amount + "</td>" +
                        "<td>" + pieces + "</td>" +
                        "<td>" + Number(kgs).toFixed(3) + "</td>" +
                        "<td>" + species.name + "</td>" +
                        "<td>" + cut.name + "</td>" +
                        "<td>" + preservation.name + "</td>" +
                        "<td>" +
                        "<button class='btn btn-xs btn-danger deletecolumn'>" +
                        "<i class='fa fa-trash'></i> Eliminar" +
                        "</button>" +
                        "</td>" +
                        "</tr>");

                    $('#quantity_type_id').val(null);
                    $('#amount').val('');
                    $('#pieces').val('');
                    $('#kgs').val('');
                    $('#species_id').val(null);
                    $('#cut_id').val(null);
                    $('#preservation_id').val(null);
                }

            });
            $(document).on('click', '.deletecolumn', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
            });
        });

        $('#sendDispatchGuide').on('submit',function(e) {

            e.preventDefault();

            let dispatchGuideTypeId = $('#dispatch_guide_type_id option:selected').val();
            let number = $('#number').val();
            let plantEntryDate = $('#plant_entry_date').val();
            let datePhysicalGuide = $('#date_physical_guide').val();
            let targetDate = $('#target_date').val();
            let enterpriseId = $('#enterprise_id option:selected').val();
            let providerId = $('#provider_id option:selected').val();
            let observations = $('#observations').val();
            let file = typeof($('#file').prop('files')[0]) === "undefined" ? $('#file').val() : $('#file').prop('files')[0];
            let countItems = $('#countItems').val();
            let items = [];

            $("#items tbody").children("tr").each(function (index, row) {
                items.push({
                    'quantityTypeId': $(row).attr("quantity_type_id"),
                    'amount': $(row).attr("amount"),
                    'pieces': $(row).attr("pieces"),
                    'kgs': $(row).attr("kgs"),
                    'speciesId': $(row).attr("species_id"),
                    'cutId': $(row).attr("cut_id"),
                    'preservationId': $(row).attr("preservation_id")
                })
            });

            let formData = new FormData();

            formData.append('dispatchGuideTypeId', dispatchGuideTypeId);
            formData.append('number', number);
            formData.append('plantEntryDate', plantEntryDate);
            formData.append('datePhysicalGuide', datePhysicalGuide);
            formData.append('targetDate', targetDate);
            formData.append('enterpriseId', enterpriseId);
            formData.append('providerId', providerId);
            formData.append('observations', observations);
            formData.append('file', file);
            formData.append('countItems', countItems);
            formData.append('items', JSON.stringify(items));

            $.ajax({
                url: "{{route('dispatchguides.store')}}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function() {
                    $("#btnCreate").text('Espere...');
                    $("#btnCreate").attr('disabled', 'disabled');
                },
                success: function (response) {
                    console.log(response)
                    Swal.fire({
                        title: 'Exito',
                        text: "Desea ingresar nueva guía",
                        showDenyButton: true,
                        showCancelButton: false,
                        icon: 'success',
                        confirmButtonText: 'Ingresar nueva guía',
                        denyButtonText: `No gracias`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#dispatch_guide_type_id').val(null);
                            $('#number').val('');
                            $('#plant_entry_date').val('');
                            $('#date_physical_guide').val('');
                            $('#target_date').val('');
                            $('#enterprise_id').val(null);
                            $('#provider_id').val(null);
                            $('#observations').val('');
                            $('#file').val('');
                            $('#countItems').val('');
                            $("#items > tbody").empty();
                            items = [];
                            $('#date_physical_guide-error').text('');
                            $("#date_physical_guide-error").css("display", "none");
                            $('#dispatch_guide_type_id-error').text('');
                            $("#dispatch_guide_type_id-error").css("display", "none");
                            $('#number-error').text('');
                            $("#number-error").css("display", "none");
                            $('#plant_entry_date-error').text('');
                            $("#plant_entry_date-error").css("display", "none");
                            $('#target_date-error').text('');
                            $("#target_date-error").css("display", "none");
                            $('#enterprise_id-error').text('');
                            $("#enterprise_id-error").css("display", "none");
                            $('#provider_id-error').text('');
                            $("#provider_id-error").css("display", "none");
                            $('#observations-error').text('');
                            $("#observations-error").css("display", "none");
                            $('#file-error').text('');
                            $("#file-error").css("display", "none");
                            $('#items-error').text('');
                            $("#items-error").css("display", "none");
                        } else if (result.isDenied) {
                            $(location).attr('href','/dispatchguides');
                        }
                    })
                },
                error: function (response) {

                    Swal.fire(
                        'Error',
                        'Revisar formulario',
                        'error'
                    )

                    if(response.responseJSON.errors){

                        $("#btnCreate").text('Guardar');
                        $("#btnCreate").removeAttr('disabled', 'disabled');

                        if (response.responseJSON.errors.datePhysicalGuide) {
                            $('#date_physical_guide-error').text('Este campo es requerido.');
                            $("#date_physical_guide-error").css("display", "block");
                        } else {
                            $('#date_physical_guide-error').text('');
                            $("#date_physical_guide-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.dispatchGuideTypeId) {
                            $('#dispatch_guide_type_id-error').text('Este campo es requerido.');
                            $("#dispatch_guide_type_id-error").css("display", "block");
                        } else {
                            $('#dispatch_guide_type_id-error').text('');
                            $("#dispatch_guide_type_id-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.number) {
                            if(response.responseJSON.errors.number === 'El numero de guía ya se encuentra en uso'){
                                $('#number-error').text('El numero de guía ya se encuentra en uso.');
                                $("#number-error").css("display", "block");
                            }else{
                                $('#number-error').text('Este campo es requerido.');
                                $("#number-error").css("display", "block");
                            }
                        } else {
                            $('#number-error').text('');
                            $("#number-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.plantEntryDate) {
                            $('#plant_entry_date-error').text('Este campo es requerido.');
                            $("#plant_entry_date-error").css("display", "block");
                        } else {
                            $('#plant_entry_date-error').text('');
                            $("#plant_entry_date-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.targetDate) {
                            $('#target_date-error').text('Este campo es requerido.');
                            $("#target_date-error").css("display", "block");
                        } else {
                            $('#target_date-error').text('');
                            $("#target_date-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.enterpriseId) {
                            $('#enterprise_id-error').text('Este campo es requerido.');
                            $("#enterprise_id-error").css("display", "block");
                        } else {
                            $('#enterprise_id-error').text('');
                            $("#enterprise_id-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.providerId) {
                            $('#provider_id-error').text('Este campo es requerido.');
                            $("#provider_id-error").css("display", "block");
                        } else {
                            $('#provider_id-error').text('');
                            $("#provider_id-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.observations) {
                            $('#observations-error').text('Este campo es requerido.');
                            $("#observations-error").css("display", "block");
                        } else {
                            $('#observations-error').text('');
                            $("#observations-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.file) {
                            $('#file-error').text('Este campo es requerido.');
                            $("#file-error").css("display", "block");
                        } else {
                            $('#file-error').text('');
                            $("#file-error").css("display", "none");
                        }

                        if (response.responseJSON.errors.countItems) {
                            $('#items-error').text('Este campo es requerido.');
                            $("#items-error").css("display", "block");
                        } else {
                            $('#items-error').text('');
                            $("#items-error").css("display", "none");
                        }
                    }
                },
                complete: function () {
                    $("#btnCreate").text('Guardar');
                    $("#btnCreate").removeAttr('disabled', 'disabled');
                },
            });

        });
    </script>
@endpush
