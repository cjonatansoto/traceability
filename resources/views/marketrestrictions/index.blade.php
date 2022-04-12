@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Restricciones de mercado</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dispatchguides.edit', $dispatchguide->id) }}">Guía de despacho</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('marketrestrictions.index') }}">Restricciones de Mercado</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <form id="sendMarketRestriction" class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Restricción de mercado</label>
                                        <select class="form-control" id="restriction_id" name="restriction_id">
                                            <option value="" selected disabled hidden>SELECCIONAR...</option>
                                            @foreach($restrictions as $restriction)
                                                @if(old('restriction_id') == $restriction->id)
                                                    <option value="{{$restriction->id}}" selected>{{$restriction->name}}</option>
                                                @else
                                                    <option value="{{$restriction->id}}">{{$restriction->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('restriction_id'))
                                            <div class="mt-3">
                                                 <span class="text-danger text-left mt-3">
                                                      {{ $errors->first('restriction_id') }}
                                                 </span>
                                            </div>
                                        @endif
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
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">Repositorio</th>
                                        <th style="color:#fff;">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($marketrestrictions as $item)
                                        <tr id="{{$item->id}}">
                                            <td>{{$item->restriction->name}}</td>
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
@endsection
@push('scripts')
    <script type="text/javascript">

        $(document).on('click', '.deletecolumn', function (event) {
            let formData = new FormData();
            let marketRestrictionId = $(this).closest("tr").attr("id");
            formData.append('_method', 'DELETE');
            $.ajax({
                url: "/marketrestrictions/"+marketRestrictionId,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    $("#" + marketRestrictionId).remove();
                },
                error: function (response) {
                    console.log(response)
                },
                complete: function () {
                    console.log('petición completada...')
                },
            });
        });

        $('#sendMarketRestriction').on('submit',function(e) {

            e.preventDefault();

            let restrictionId = $('#restriction_id option:selected').val();
            let file = typeof($('#file').prop('files')[0]) === "undefined" ? $('#file').val() : $('#file').prop('files')[0];

            let formData = new FormData();

            formData.append('restrictionId', restrictionId);
            formData.append('file', file);

            $.ajax({
                url: "{{route('marketrestrictions.store')}}",
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

                    $('#items >tbody').append("<tr id='"+response.marketrestriction.id+"'>" +
                        "<td>"+response.marketrestriction.restriction+"</td>" +
                        "<td><a href='"+response.marketrestriction.file+"' download>"+
                        "<i class='fa fa-download'></i> Descargar"+
                        "</a>"+
                        "</td>" +
                        "<td>" +
                        "<button class='btn btn-xs btn-danger deletecolumn'>" +
                        "<i class='fa fa-trash'></i> Eliminar" +
                        "</button>" +
                        "</td>" +
                        "</tr>");

                    $('#restriction_id').val(null);
                    $('#file').val(null);

                    Swal.fire(
                        'Éxito',
                        'Los datos se han ingresado correctamente',
                        'success'
                    )

                },
                error: function (response) {
                    if (response.responseJSON.errors.restrictionId) {
                        $('#name-error').text('Este campo es requerido.');
                        $("#name-error").css("display", "block");
                    } else {
                        $('#laboratory_id-error').text('');
                        $("#laboratory_id-error").css("display", "none");
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
