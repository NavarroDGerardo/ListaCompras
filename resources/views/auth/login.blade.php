@extends('layouts.header')

@section('content')

    <div class="card" style="width: 30%; margin: 15% 35%">
        <h1 class="card-tittle" style="text-align: center; background-color: #28a745; color: white; height: 60px">Log in</h1>
        <form action="{{ route('auth.login')}}" method="POST" id="form">
            @csrf
            <table style="width: 100%; margin-left: 20%; margin-top: 25px;" >
                <tbody>
                    <tr>
                        <td>
                            <label for="email">E-mail</label>
                        </td>
                        <td>
                            <input type="email" name="email" id="email" placeholder="you@company.com" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Password</label>
                        </td>
                        <td>
                            <input type="password" name="password" id="password" placeholder="**********" required/>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <button class="btn btn-success" type="submit" style="margin: 30px 25%; width: 50%;">Iniciar sesión</button>
            </div>
        </form>
        <a style="text-align: center; margin-bottom: 25px; color: #28a745;" href="{{ route('auth.view-register') }}">Crea una cuenta</a>
    </div>

@endsection
