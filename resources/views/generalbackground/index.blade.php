@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Antecedentes generales</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dispatchguides.edit',$dispatchguide->id) }}">Guía de despacho</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('generalbackground.index') }}">Antecedentes
                        Generales</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <form id="sendGeneralBackground" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Centro de cultivo</label>
                                        <select class="form-control"
                                                id="place_id">
                                            <option value="" selected disabled hidden>SELECCIONAR...
                                            </option>
                                            @foreach($places as $place)
                                                <option value="{{$place->id}}">{{$place->code}}
                                                    -{{$place->name}}</option>
                                            @endforeach
                                        </select>
                                        <label id="place_id-error" class="error"
                                               for="place_id"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jaula</label>
                                        <input type="text" class="form-control" id="cage">
                                        <label id="cage-error" class="error"
                                               for="cage"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha de cosecha</label>
                                        <input type="date" class="form-control"
                                               id="harvest_date" max="{{ now()->toDateString('Y-m-d') }}">
                                        <label id="harvest_date-error" class="error"
                                               for="harvest_date"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Declaración de garantia</label>
                                        <input type="text" class="form-control" id="warranty_statement">
                                        <label id="warranty_statement-error" class="error"
                                               for="warranty_statement"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Repositorio</label>
                                        <input type="file"
                                               id="file" class="form-control">
                                        <label id="file-error" class="error"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button id="btnAdd" type="submit" class="btn btn-primary btn-lg">
                                        Agregar
                                    </button>
                                </div>

                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" style="width:100%" id="items">
                                    <thead style="background-color:#6777ef">
                                    <tr>
                                        <th style="color:#fff;">Centro de cultivo</th>
                                        <th style="color:#fff;">Jaula</th>
                                        <th style="color:#fff;">Declaración de garantia</th>
                                        <th style="color:#fff;">Fecha de cosecha</th>
                                        <th style="color:#fff;">Repositorio</th>
                                        <th style="color:#fff;">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($generalbackground as $item)
                                        <tr id="{{$item->id}}">
                                            <td>{{$item->place->name}}</td>
                                            <td>{{$item->cage}}</td>
                                            <td>{{$item->warranty_statement}}</td>
                                            <td>{{date('d-m-Y', strtotime($item->harvest_date))}}</td>
                                            <td>
                                                <a href="{{asset($item->file)}}" download>
                                                    <i class='fa fa-download'></i> Descargar
                                                </a>
                                            </td>
                                            <td>
                                                <button class='btn btn-xs btn-danger deletecolumn'>
                                                    <i class='fa fa-trash'></i> Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                    <a href="{{ route('dispatchguides.index') }}" class="btn btn-primary">Cancelar</a>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalPlace" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar centro de cultivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="sendPlace" class="mb-3">
                <div class="modal-body">
                   <div class="row">
                       <div class="col-md-12">
                           <div class="form-group">
                               <label>Nombre</label>
                               <input type="text" class="form-control" id="name-place"/>
                               <label id="name-place-error" class="error"
                                      for="name-lace"></label>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="form-group">
                               <label>Codigo sernapesca</label>
                               <input type="text" class="form-control" id="code-place"/>
                               <label id="code-place-error" class="error"
                                      for="code-place"></label>
                           </div>
                       </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="#btnAddPlace" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.deletecolumn', function (event) {
            let formData = new FormData();
            let dispatchGuideId = $(this).closest("tr").attr("id");
            formData.append('_method', 'DELETE');
            $.ajax({
                url: "/generalbackground/"+dispatchGuideId,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    $("#" + dispatchGuideId).remove();
                },
                error: function (response) {
                    console.log(response)
                },
                complete: function () {
                    console.log('petición completada...')
                },
            });
        });

        $('#sendGeneralBackground').on('submit',function(e) {

            e.preventDefault();
            let placeId = $('#place_id option:selected').val();
            let cage = $('#cage').val();
            let warrantyStatement = $('#warranty_statement').val();
            let harvestDate = $('#harvest_date').val();
            let file = typeof($('#file').prop('files')[0]) === "undefined" ? $('#file').val() : $('#file').prop('files')[0];

            let formData = new FormData();

            formData.append('placeId', placeId);
            formData.append('cage', cage);
            formData.append('warrantyStatement', warrantyStatement);
            formData.append('harvestDate', harvestDate);
            formData.append('file', file);

            $.ajax({
                url: "{{route('generalbackground.store')}}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function() {
                    $("#btnAdd").text('Espere...');
                    $("#btnAdd").attr('disabled', 'disabled');
                },
                success: function (response) {

                    $('#items >tbody').append("<tr id='"+response.generalBackground.id+"'>" +
                        "<td>"+response.generalBackground.place+"</td>" +
                        "<td>"+response.generalBackground.cage+"</td>" +
                        "<td>"+response.generalBackground.warrantyStatement+"</td>" +
                        "<td>"+response.generalBackground.harvestDate+"</td>" +
                        "<td><a href='"+response.generalBackground.file+"' download>"+
                            "<i class='fa fa-download'></i> Descargar"+
                        "</a>"+
                        "</td>" +
                        "<td>" +
                        "<button class='btn btn-xs btn-danger deletecolumn'>" +
                        "<i class='fa fa-trash'></i> Eliminar" +
                        "</button>" +
                        "</td>" +
                        "</tr>");

                    $('#place_id').val(null);
                    $('#cage').val('');
                    $('#warranty_statement').val('');
                    $('#harvest_date').val('');
                    $('#file').val(null);

                    Swal.fire(
                        'Éxito',
                        'Los datos se han ingresado correctamente',
                        'success'
                    )

                },
                error: function (response) {
                    if (response.responseJSON.errors.placeId) {
                        $('#place_id-error').text('Este campo es requerido.');
                        $("#place_id-error").css("display", "block");
                    } else {
                        $('#place_id-error').text('');
                        $("#place_id-error").css("display", "none");
                    }

                    if (response.responseJSON.errors.cage) {
                        $('#cage-error').text('Este campo es requerido.');
                        $("#cage-error").css("display", "block");
                    } else {
                        $('#cage-error').text('');
                        $("#cage-error").css("display", "none");
                    }

                    if (response.responseJSON.errors.warrantyStatement) {
                        $('#warranty_statement-error').text('Este campo es requerido.');
                        $("#warranty_statement-error").css("display", "block");
                    } else {
                        $('#warranty_statement-error').text('');
                        $("#warranty_statement-error").css("display", "none");
                    }

                    if (response.responseJSON.errors.harvestDate) {
                        $('#harvest_date-error').text('Este campo es requerido.');
                        $("#harvest_date-error").css("display", "block");
                    } else {
                        $('#harvest_date-error').text('');
                        $("#harvest_date-error").css("display", "none");
                    }

                    if (response.responseJSON.errors.file) {
                        $('#file-error').text('Este campo es requerido.');
                        $("#file-error").css("display", "block");
                    } else {
                        $('#file-error').text('');
                        $("#file-error").css("display", "none");
                    }
                },
                complete: function () {
                    $("#btnAdd").text('Agregar');
                    $("#btnAdd").removeAttr('disabled', 'disabled');
                },
            });

        });

        $('#sendPlace').on('submit',function(e) {

            e.preventDefault();

            let name = $('#name-place').val();
            let code = $('#code-place').val();

            let formData = new FormData();

            formData.append('namePlace', name);
            formData.append('codePlace', code);

            $.ajax({
                url: "{{route('places.store')}}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function() {
                    $("#btnAddPlace").text('Espere...');
                    $("#btnAddPlace").attr('disabled', 'disabled');
                },
                success: function (response) {

                    console.log(response);

                    Swal.fire(
                        'Éxito',
                        'Los datos se han ingresado correctamente',
                        'success'
                    )

                },
                error: function (response) {

                    console.log(response.responseJSON.errors)

                    if (response.responseJSON.errors.namePlace) {
                        if(response.responseJSON.errors.namePlace === 'El valor del campo code place ya está en uso.'){
                            $('#name-place-error').text('El valor del campo ya está en uso.');
                            $("#name-place-error").css("display", "block");
                        }else {
                            $('#name-place-error').text('Este campo es requerido.');
                            $("#name-place-error").css("display", "block");
                        }
                    } else {
                        $('#name-place-error').text('');
                        $("#name-place-error").css("display", "none");
                    }

                    if (response.responseJSON.errors.codePlace) {
                        $('#code-place-error').text('Este campo es requerido.');
                        $("#code-place-error").css("display", "block");
                    } else {
                        $('#code-place-error').text('');
                        $("#code-place-error").css("display", "none");
                    }

                },
                complete: function () {
                    $("#btnAddPlace").text('Agregar');
                    $("#btnAddPlace").removeAttr('disabled', 'disabled');
                },
            });

        });
    </script>
@endpush
