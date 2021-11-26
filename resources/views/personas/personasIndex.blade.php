@extends('plantilla')

@section('contenido')

<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="cart-title">
                        <h2><a href="/persona/create"> AGREGAR CLIENTE </a></h2>
                        <h2>LISTADO DE CLIENTES</h2>
                    </div>
                    <table border="1">
                            <thead>
                                <th>Area(s)</th>
                                <th>ID</th>
                                <th>Usuario Admin</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Codigo</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                            </thead>
                            <tbody>
                                @foreach ($personas as $persona )
                                    <tr>
                                        <td>
                                            <ul>
                                                @foreach ($persona->areas as $area)
                                                    <li>{{ $area->nombre_area }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{route('persona.show',$persona->id)}}">
                                                 {{ $persona->id}}
                                            <a>
                                        </td>
                                        <td>{{ $persona->user->name }} ({{ $persona->user->email }})</td>
                                        <td>{{ $persona->nombre}}</td>
                                        <td>{{ $persona->apellido_paterno}}</td>
                                        <td>{{ $persona->apellido_materno}}</td>
                                        <td>{{ $persona->identificador}}</td>
                                        <td>{{ $persona->correo}}</td>
                                        <td>{{ $persona->telefono}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

@endsection
