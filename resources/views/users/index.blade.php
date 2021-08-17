@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top:100px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Użytkownicy
                            <a href="{{ url('add-peoples') }}" class="btn btn-primary float-end">Dodaj użytkownika</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mx-auto">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Awatar</th>
                                    <th>Ranga</th>
                                    <th>Stworzony</th>
                                    <th>Edytuj</th>
                                    <th>Usuń</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td class="text-center align-middle">{{ $item->id }}</td>
                                        <td class="text-center align-middle">{{ $item->name }}</td>
                                        <td class="text-center align-middle">{{ $item->email }}</td>
                                        <td>
                                            <img src="{{ ('/users/avatar/' . $item->profile_image) }}"
                                                class="mx-auto d-block" width="70px" height="70px" alt="Image">
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($item->rank == 1)
                                                Administrator
                                            @else
                                                Użytkownik
                                            @endif</td>
                                        <td class="text-center align-middle">{{ $item->updated_at }}</td>
                                        <td class="text-center align-middle">
                                            <a href="{{ url('edit-peoples/' . $item->id) }}"
                                                class="btn btn-primary btn-sm">Edytuj</a>
                                        </td>
                                        <td class="text-center align-middle">
                                            {{-- <a href="{{ url('delete-student/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                                            <form action="{{ url('delete-peoples/' . $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
