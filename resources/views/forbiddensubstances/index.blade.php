@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sustancias prohibidas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dispatchguides.edit', $dispatchguide->id) }}">Guía de despacho</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('forbiddensubstances.index') }}">Sustancias Prohibidas</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <form id="sendForbiddenSubstance" class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Numero</label>
                                        <input type="text" class="form-control" id="number" onkeypress="return valideKey(event);">
                                        <label id="number-error" class="error"
                                               for="number"></label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Laboratorio</label>
                                        <select class="form-control"
                                                id="laboratory_id">
                                            <option value="" selected disabled hidden>SELECCIONAR...
                                            </option>
                                            @foreach($laboratories as $laboratory)
                                                <option value="{{$laboratory->id}}">{{$laboratory->name}}</option>
                                            @endforeach
                                        </select>
                                        <label id="laboratory_id-error" class="error"
                                               for="laboratory_id"></label>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fecha de reporte</label>
                                        <input type="date" class="form-control"
                                               id="report_date" max="{{ now()->toDateString('Y-m-d') }}">
                                        <label id="report_date-error" class="error"
                                               for="report_date"></label>
                                    </div>
                                </div>
                                <div class="col-md-5">
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
                                        <th style="color:#fff;">Numero</th>
                                        <th style="color:#fff;">Laboratorio</th>
                                        <th style="color:#fff;">Fecha de reporte</th>
                                        <th style="color:#fff;">Repositorio</th>
                                        <th style="color:#fff;">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($forbiddensubstances as $item)
                                        <tr id="{{$item->id}}">
                                            <td>{{$item->number}}</td>
                                            <td>{{$item->laboratory->name}}</td>
                                            <td>{{date('d-m-Y', strtotime($item->report_date))}}</td>
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
                    <a href="{{ route('analysisresults.index') }}" class="btn btn-primary">Cancelar</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">

        $(document).on('click', '.deletecolumn', function (event) {
            let formData = new FormData();
            let forbiddenSubstanceId = $(this).closest("tr").attr("id");
            formData.append('_method', 'DELETE');
            $.ajax({
                url: "/forbiddensubstances/"+forbiddenSubstanceId,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    $("#" + forbiddenSubstanceId).remove();
                },
                error: function (response) {
                    console.log(response)
                },
                complete: function () {
                    console.log('petición completada...')
                },
            });
        });

        $('#sendForbiddenSubstance').on('submit',function(e) {

            e.preventDefault();

            let laboratoryId = $('#laboratory_id option:selected').val();
            let number = $('#number').val();
            let reportDate = $('#report_date').val();
            let file = typeof($('#file').prop('files')[0]) === "undefined" ? $('#file').val() : $('#file').prop('files')[0];

            let formData = new FormData();

            formData.append('laboratoryId', laboratoryId);
            formData.append('number', number);
            formData.append('reportDate', reportDate);
            formData.append('file', file);

            $.ajax({
                url: "{{route('forbiddensubstances.store')}}",
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

                    $('#items >tbody').append("<tr id='"+response.forbiddensubstances.id+"'>" +
                        "<td>"+response.forbiddensubstances.number+"</td>" +
                        "<td>"+response.forbiddensubstances.laboratory+"</td>" +
                        "<td>"+response.forbiddensubstances.reportDate+"</td>" +
                        "<td><a href='"+response.forbiddensubstances.file+"' download>"+
                        "<i class='fa fa-download'></i> Descargar"+
                        "</a>"+
                        "</td>" +
                        "<td>" +
                        "<button class='btn btn-xs btn-danger deletecolumn'>" +
                        "<i class='fa fa-trash'></i> Eliminar" +
                        "</button>" +
                        "</td>" +
                        "</tr>");

                    $('#laboratory_id').val(null);
                    $('#number').val('');
                    $('#report_date').val('');
                    $('#file').val(null);

                    Swal.fire(
                        'Éxito',
                        'Los datos se han ingresado correctamente',
                        'success'
                    )

                },
                error: function (response) {
                    if (response.responseJSON.errors.laboratoryId) {
                        $('#laboratory_id-error').text('Este campo es requerido.');
                        $("#laboratory_id-error").css("display", "block");
                    } else {
                        $('#laboratory_id-error').text('');
                        $("#laboratory_id-error").css("display", "none");
                    }

                    if (response.responseJSON.errors.number) {
                        $('#number-error').text('Este campo es requerido.');
                        $("#number-error").css("display", "block");
                    } else {
                        $('#number-error').text('');
                        $("#number-error").css("display", "none");
                    }

                    if (response.responseJSON.errors.reportDate) {
                        $('#report_date-error').text('Este campo es requerido.');
                        $("#report_date-error").css("display", "block");
                    } else {
                        $('#report_date-error').text('');
                        $("#report_date-error").css("display", "none");
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
    </script>
@endpush
