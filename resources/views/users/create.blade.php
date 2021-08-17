@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top:100px;">
        <div class="row justify-content-center">
            <div class="col-md-5">

                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Dodaj użytkownika
                            <a href="{{ url('peoples') }}" class="btn btn-danger float-end">POWRÓT</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('add-peoples') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="">Login</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">E-mail</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Hasło</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Ranga</label>
                                <select name="rank" id="rank-select">
                                    <option value="1">Administrator</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Awatar</label>
                                <input type="file" name="profile_image" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Dodaj</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
