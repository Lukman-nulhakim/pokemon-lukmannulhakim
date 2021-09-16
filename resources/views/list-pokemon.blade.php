@extends('master')
@section('title', 'List Pokemon')
@section('active', 'list-pokemon')
@section('content')
    <div class="container">
        <div class="text-center">
            <h2 class="py-4">List Pokemon</h2>
        </div>
        <div class="row" id="card-pokemon">
            {{-- List pokemon --}}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            
            // All Data
            const urlListPokemon = "https://pokeapi.co/api/v2/pokemon?limit=56&offset=100"
            $.ajax({
                url: urlListPokemon,
                type: "GET",
                success : res => {
                    let allPokemon = res.results;
                    $.each(allPokemon, function(i, pokemon){
                        listPokemon(pokemon)
                    });
                },
                error : res => {
                    console.log("Oopss .." + res.status);
                }
            });

            // list pokemon
            function listPokemon(pokemon){
                let url = pokemon.url;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: res => {
                        let name = res.name;
                        let image = res.sprites.front_default;
                        let card = $('#card-pokemon');
                        let urlDetail = url.slice(34, 37);
                        let html = `
                                    <div class="col-lg-3 col-md-4 col-sm-12 col-12 py-2">
                                        <div class="card">
                                        <img src="${image}" class="card-img-top bg-info bg-gradient" height="150px" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title mb-2">${name}</h5>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ url('pokemon/detail/${urlDetail}' ) }}" class="btn btn-primary btn-sm rounded-pill"><b>Detail</b> <i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                `
                            card.append(html);
                    },
                    error: res => {
                        console.log(res.status);
                    }
                });
            }
        });
    </script>
@endsection