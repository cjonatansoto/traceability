@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Error en asignación de kilos en lotes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                @include('sweetalert::alert')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="/lots/assignment/{{$items[0]['lot_id']}}">Reintentar carga...</a>
                            <br/>
                            <br/>
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef">
                                <tr>
                                    @if($items[0]['quantity_type_id'] == 1)
                                        <th style="color:#fff;">Numero de caja</th>
                                    @else
                                        <th style="color:#fff;">Numero de Bins</th>
                                    @endif

                                    <th style="color:#fff;">Motivo</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $row)
                                        @if($row['status'] == false)
                                            <tr class="table-danger">
                                                <td>{{$row['items']}}</td>
                                                <td>{{$row['message']}}</td>
                                            </tr>
                                        @else
                                            <tr class="table-success">
                                                <td>{{$row['items']}}</td>
                                                <td>{{$row['message']}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Numero de caja</th>
                                    <th>Motivo</th>
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
