@extends('plantilla')

@section('contenido')


<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>FORMULARIO PARA {{isset($persona) ? 'EDITAR' : 'CREAR'}} CLIENTES</h2>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Por favor corrige los siguientes errores</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(isset($persona))
                            <form id="contact-form" action="{{route('persona.update', $persona)}}" method="POST">
                            @method('PATCH')
                        @else
                                <form id="contact-form" action="{{ route('persona.store') }}" method="POST"  enctype="multipart/form-data">
                        @endif
                            @csrf
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-12 mb-3"><!-- nombre -->
                                <input type="text" class="form-control" id="name" placeholder="Tu nombre" name="nombre" id="name"  value="{{$persona->nombre ?? ''}}">
                            </div>
                            <div class="col-12 mb-3"><!-- apellido paterno -->
                                <input type="text" placeholder="Tu Apellido Paterno" class="form-control" name="apellido_paterno" id="apellido_paterno"  value="{{$persona->apellido_paterno ?? ''}}">
                            </div>
                            <div class="col-12 mb-3"><!-- apellido materno -->
                                <input type="text" placeholder="Tu Apellido Materno" class="form-control" name="apellido_materno" id="apellido_materno"  value="{{$persona->apellido_materno ?? ''}}">
                            </div>
                            <div class="col-12 mb-3"><!-- identificador -->
                                <input type="text" placeholder="Tu identificador" class="form-control" name="identificador" id="identificador"  value="{{$persona->identificador ?? ''}}">
                            </div>
                            <div class="col-12 mb-3"><!-- telefono -->
                                <input type="text" placeholder="Tu teléfono" class="form-control" name="telefono" id="telefono"  value="{{$persona->telefono ?? ''}}">
                            </div>
                            <div class="col-12 mb-3"><!-- correo -->
                                <input type="email" placeholder="Tu Correo" class="form-control" name="correo" id="correo" value="{{$persona->correo ?? ''}}">
                            </div>
                            <div class="col-12 mb-3">
                                <select name = "area_id[]" id="area_id" class="w-100" multiple>
                                    @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" {{ isset($persona) && array_search($area->id, $persona->areas->pluck('id')->toArray()) === false ? '' : 'selected' }} >
                                        {{ $area->nombre_area }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-12 mb-3"><!-- archivo -->
                                <input type="file" class="form-control" name="archivo" id="archivo">
                                <!-- value="{{$persona->archivo_original ?? ''}} -->
                            </div>

                            <br><input type= "submit" value="Enviar">

                            {{-- <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                </div>
                                <div class="custom-control custom-checkbox d-block">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Ship to a different address</label>
                                </div>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Gracias por crear tu cuenta!</h5>
                    <ul class="summary-table">
                        <li><span>En chaxxztore agradecemos tu preferencia!</span> <span></span></li>
                        {{-- <li><span>delivery:</span> <span></span></li>
                        <li><span>total:</span> <span></span></li> --}}
                    </ul>

                    {{-- <div class="payment-method">
                        <!-- Cash on delivery -->
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="cod" checked>
                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                        </div>
                        <!-- Paypal -->
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="paypal">
                            <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="img/core-img/paypal.png" alt=""></label>
                        </div>
                    </div> --}}

                    {{-- <div class="cart-btn mt-100">
                        <a href="#" class="btn amado-btn w-100">Checkout</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ##### Main Content Wrapper End ##### -->


@endsection
