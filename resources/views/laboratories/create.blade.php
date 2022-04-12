@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div>
                <h3 class="page__heading">Nuevo registro</h3>
                <ul style="background-color: #ffffff" class="breadcrumb breadcrumb-transparent breadcrumb-dot my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('laboratories.index') }}">Laboratorios</a>
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
                            {!! Form::open(array('route' => 'laboratories.store','method'=>'POST')) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                        @if ($errors->has('name'))
                                            <div class="mt-3">
                                                <span class="text-danger text-left mt-3">
                                                    {{ $errors->first('name') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Rut</label>
                                        {!! Form::text('rut', null, array('class' => 'form-control')) !!}
                                        @if ($errors->has('rut'))
                                            <div class="mt-3">
                                                <span class="text-danger text-left mt-3">
                                                    {{ $errors->first('rut') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
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