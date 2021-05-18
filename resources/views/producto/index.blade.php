@extends('layouts.header')

@section('content')
    <div class="container" style="background-color: white; padding: 0px;">
        <h1 id="idLista" style="visibility: hidden; position: absolute; top: -9999px;">{{$lista->id}}</h1>
        <h1 style="background-color: #28a745; padding: 10px 0; color:white; text-align: center">{{$lista->name}}</h1>
        <a style="color: #28a745;" href="{{ route('lista.index') }}">Regresar a listas</a>

        <h2>agregar producto</h2>

        <div class="row">
            <div class="col-12">
                <input type="text" name="nombreProducto" id="nombreProducto" placeholder="nombre">
                <input type="number" name="cantidad" id="cantidadProducto" placeholder="0">
                <input type="text" name="precio" id="precioProducto" placeholder="$00.00">
                <input type="button" value="Agregar" onclick="agregarProducto()">
            </div>
        </div>

        <div>
            <h2>Productos en la lista:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>NOMBRE</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td id="producto_{{$producto->id}}">{{$producto->id}}</td>
                            <td>{{$producto->name}}</td>
                            <td>{{$producto->cantidad}}</td>
                            <td>{{$producto->precio}}</td>
                            <td>
                                <a style="padding-left: 15%; color: red; cursor: pointer;" onclick="deleteProducto({{$producto->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function agregarProducto(){
            let nombreProducto = $('#nombreProducto').val();
            let cantidadProducto = $('#cantidadProducto').val();
            let precioProducto = $('#precioProducto').val();
            let idLista = $('#idLista').text();
            $.ajax({
                url: '{{ route('producto.store') }}',
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: nombreProducto,
                    cantidad: cantidadProducto,
                    precio: precioProducto,
                    lista_id: idLista
                }
            })
            .done(function(response) {
                //console.log(response);
                $('#nombreProducto').val('');
                $('#cantidadProducto').val('');
                $('#precioProducto').val('');
                $('.table tbody').append(`
                    <tr>
                        <td id="producto_`+ response.id +`">`+response.id+`</td>
                        <td>`+response.name+`</td>
                        <td>`+response.cantidad+`</td>
                        <td>`+response.precio+`</td>
                        <td>
                            <a style="padding-left: 15%; color: red; cursor: pointer;" onclick="deleteProducto(`+response.id+`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                `);
            })
            .fail(function(jqXHR, response) {
                console.log('Fallido', response);
            });
        }

        function deleteProducto(idProducto){
            let url_producto = '{{ route('producto.destroy', 0) }}';
            url_producto = url_producto.replace('0', idProducto);
            let id_producto = '#producto_' + idProducto;

            $.ajax({
                url: url_producto,
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: idProducto
                }
            })
            .done(function(response) {
                //console.log(id_lista);
                $(id_producto).parent().remove();
            })
            .fail(function(jqXHR, response) {
                console.log('Fallido', response);
            });
        }
    </script>
@endsection
