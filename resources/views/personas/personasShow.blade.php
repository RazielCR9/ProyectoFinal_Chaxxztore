@extends('plantilla')

@section('contenido')

<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-title">
                        <h2>INFORMACIÓN DE: {{$persona->nombre}}</h2>
                    </div>
                    <br>
                    <a href="{{route('persona.index')}}"> Listado de Personas </a>
                    <br>
                    <br>
                        <ul>
                            <li>{{$persona->nombre}}</li>
                            <li>{{$persona->apellido_paterno}}</li>
                            <li>{{$persona->apellido_materno}}</li>
                            <li>{{$persona->identificador}}</li>
                            <li>{{$persona->telefono}}</li>
                            <li>{{$persona->correo}}</li>
                        </ul>
                        <br><br><br>
                        <a href="{{route('persona.edit',$persona)}}"> Editar </a>
                        <hr>
                        <form action = "{{route('persona.destroy', $persona)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Borrar">
                        </form>
                        <hr>
                        <h3>Archivo:</h3>
                        <h5>
                            <a href= "{{ route('descargar', $persona) }}">{{ $persona->archivo_original }}</a>
                        </h5>

                </div>
            </div>

        </div>
    </div>
</div>
</div>

@endsection
