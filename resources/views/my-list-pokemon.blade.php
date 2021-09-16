@extends('master')
@section('title', 'My List Pokemon')
@section('active', 'my-list-pokemon')
@section('content')
    <div class="container">
        <div class="text-center">
            <h2 class="py-4">My List Pokemon</h2>
        </div>
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary position-relative mb-2">
                        Total Pokemon
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($mylistPokemon) }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="bg-light">
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Abilities</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if (count($mylistPokemon) > 0)
                                @foreach ($mylistPokemon as $pokemon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ $pokemon->image }}" alt="" width="50px">
                                        </td>
                                        <td>{{ $pokemon->name }}</td>
                                        <td>{{ $pokemon->type }}</td>
                                        <td>{{ $pokemon->abilities }}</td>
                                        <td>
                                            <a href="{{ url('delete/pokemon/'.$pokemon->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pokemon ini ?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">Belum ada my pokemon list ..</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection