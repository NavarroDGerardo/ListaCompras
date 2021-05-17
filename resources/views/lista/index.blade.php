@extends('layouts.header')

@section('content')
    <div class="container" style="background-color: white;">
        <div class="row">
            <div class="col-12" style="padding: 0;">
                <h1 style="background-color: #28a745; padding: 10px 0; color:white; text-align: center">Listas de compras de @auth {{ auth()->user()->name }} @endauth </h1>

            </div>
        </div>

        <div class="row">
            <div class="col-10">
                <input type="text" name="nombreLista" id="nombreLista">
                <input type="button" value="Crear" onclick="createLista()">
            </div>
            <div class="col-2">
                <a style="color: #28a745;" href="{{ route('auth.logout') }}">Cerrar Sesión</a>
            </div>
        </div>

        <div id="shareModule" class="row" style="display: none">
            <div class="col-12">
                <hr>
                <h2 id="tituloShare">Compartir lista de compras: </h2>
                <h4 id="idShareLista">Id: </h4>
                <input type="email" name="correoShare" id="correoShare">
                <input type="button" value="Compartir" onclick="compartir()">
            </div>
            <div class="col-12">
                <a onclick="cancelarShare()" style="color: #28a745; cursor: pointer;">Cancelar</a>
            </div>
        </div>

        <hr>

        <div>
            <h2>Listas de compras</h2>
            <table id="tablaLP"  class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>NOMBRE</th>
                        <th>INSPECCIONAR</th>
                        <th>COMPARTIR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listasPersonales as $lista)
                        <tr>
                            <td id="lista_{{$lista->id}}">{{$lista->id}}</td>
                            <td>{{$lista->name}}</td>
                            <td>
                                <a style="padding-left: 15%; color: #28a745; cursor: pointer;" href="{{ route('producto.edit', ['lista' => $lista])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a style="padding-left: 15%; color: #28a745; cursor: pointer;" onclick="displayShareModule({{$lista->id}}, '{{$lista->name}}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                        <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a style="padding-left: 15%; color: red; cursor: pointer;" onclick="deleteLista({{$lista->id}})">
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

        <div>
            <h2>Listas de compras compras</h2>
            <table id="tablaLC" class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>NOMBRE</th>
                        <th>INSPECCIONAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listasCompartidas as $lista)
                        <tr>
                            <th>{{$lista->id}}</th>
                            <th>{{$lista->name}}</th>
                            <th>
                                <a href="{{ route('producto.edit', ['lista' => $lista])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function createLista() {
            let nombreLista = $('#nombreLista').val();
            $.ajax({
                url: '{{ route('lista.store') }}',
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: nombreLista
                }
            })
            .done(function(response) {
                //console.log(response);
                $('#nombreLista').val('');
                $('#tablaLP tbody').append(`
                    <tr>
                        <td id="lista_`+response.id+`">`+response.id+`</td>
                        <td>`+response.name+`</td>
                        <td>
                            <a style="padding-left: 15%; color: #28a745; cursor: pointer;" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <a style="padding-left: 15%; color: #28a745; cursor: pointer;" onclick="displayShareModule(`+response.id+`, '`+response.name+`')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                    <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <a style="padding-left: 15%; color: red; cursor: pointer;" onclick="deleteLista(`+response.id+`)">
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

        function deleteLista(idLista){
            let url_listas = '{{ route('lista.destroy', 0) }}';
            url_listas = url_listas.replace('0', idLista);

            console.log(url_listas);
            let id_lista = '#lista_' + idLista;
            $.ajax({
                url: url_listas,
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: idLista
                }
            })
            .done(function(response) {
                //console.log(id_lista);
                $(id_lista).parent().remove();
            })
            .fail(function(jqXHR, response) {
                console.log('Fallido', response);
            });
        }

        function displayShareModule(idLista, nombreLista){
            $('#tituloShare').text("Compartir lista de compras: " + nombreLista);
            $('#idShareLista').text("ID: " + idLista);
            var x = document.getElementById("shareModule");
            x.style.display = "block";
        }

        function cancelarShare(){
            var x = document.getElementById("shareModule");
            x.style.display = "none";
        }

        function compartir(){
            let idLista = $('#idShareLista').text();
            idLista = idLista.split(" ")[1];
            let emailShare = $('#correoShare').val();
            console.log(idLista + " " + emailShare);
            $.ajax({
                url: '{{ route('share.store') }}',
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    email: emailShare,
                    lista_id: idLista
                }
            })
            .done(function(response) {
                $('#correoShare').val('');
                cancelarShare();
                alert("se compartio exitosamente");
                //console.log(response);
            })
            .fail(function(jqXHR, response) {
                console.log('Fallido', response);
            });
        }
    </script>
@endsection
