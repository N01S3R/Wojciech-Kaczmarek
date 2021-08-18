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
                        <h4>Edycja użytkownika
                            <a href="{{ url('peoples') }}" class="btn btn-danger float-end">POWRÓT</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('update-peoples/' . $users->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="">Login</label>
                                <input type="text" name="name" value="{{ $users->name }}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">E-mail</label>
                                <input type="text" name="email" value="{{ $users->email }}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Hasło</label>
                                <input type="text" name="password" value="" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Ranga</label>
                                <select name="rank" id="rank-select">
                                    <option value={{ $users->rank }}>Administrator</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Awatar</label>
                                <input type="file" name="profile_image" class="form-control">
                                <img src="{{ asset('uploads/peoples/' . $users->profile_image) }}" width="70px"
                                    height="70px" alt="Image">
                            </div>
                            <div class="form-group mb-3">
                                <img src="{{ asset('/user/avatar/' . $item->profile_image) }}" class="mx-auto d-block"
                                    width="70px" height="70px" alt="Image">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Edytuj</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
