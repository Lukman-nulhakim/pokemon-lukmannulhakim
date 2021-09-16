@extends('master')
@section('title', 'Pokemon Detail')
@section('content')
    <div class="container">
        <div class="text-center">
            <h2 class="py-4">Pokemon Detail</h2>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 border-end border-warning">
                                <img src="{{ $details->sprites->front_default }}" alt="" width="100%" id="image">
                            </div>
                            <input type="hidden" value="{{ csrf_token() }}" id="csrf">
                            <input type="hidden" value="{{ $details->name }}" id="name">
                            <input type="hidden" value="{{ $details->sprites->front_default }}" id="image">
                            <input type="hidden" value="@if (count($details->types) > 0)@foreach ($details->types as $item){{ $item->type->name }},@endforeach @endif" id="type">
                            <input type="hidden" value="@if (count($details->abilities) > 0)@foreach ($details->abilities as $item){{ $item->ability->name }},@endforeach @endif" id="abilities">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-3">
                                <h5>Name : {{ $details->name }}</h5>
                                <hr class="m-0">
                                <h5>Type : 
                                    @if (count($details->types) > 0)
                                        @foreach ($details->types as $item)
                                            {{ $item->type->name }}, 
                                        @endforeach
                                    @endif
                                </h5>
                                <hr class="m-0">
                                <h5>Abilities : 
                                    @if (count($details->abilities) > 0)
                                        @foreach ($details->abilities as $item)
                                            {{ $item->ability->name }}, 
                                        @endforeach
                                    @endif
                                </h5>
                                <hr class="m-0">
                                <h5>Height : {{ $details->height }}</h5>
                                <hr class="m-0">
                                <h5>Weight : {{ $details->weight }}</h5>
                                <hr class="m-0">
                                <div class="text-center mt-5">
                                    <button class="btn btn-primary text-center rounded-pill" id="tangkap">Tangkap</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            let persentase = 0;
            let name = $('#name').val();
            let image = $('#image').attr('src');
            let type = $('#type').val();
            let abilities = $('#abilities').val();
            let csrf = $('#csrf').val();

            // Alert notif sukses
            let toastMixin = Swal.mixin({
                toast: true,
                icon: 'success',
                title: 'General Title',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            $(document).on('click', '#tangkap', function(){
                persentase ++;
                if ((persentase % 2) == 0) {
                    $.ajax({
                        url: window.location.origin + '/save/pokemon',
                        type: 'POST',
                        data: {
                            _token: csrf,
                            name: name,
                            image: image,
                            type: type,
                            abilities: abilities
                        },
                        success: res => {
                            if (res.status) {
                                toastMixin.fire({
                                    animation: true,
                                    title: res.message
                                });
                            }
                        },
                        error: res => {
                            console.log(res.status)
                        }
                    });
                    console.log('masuk');
                } else {
                    console.log('gagal')
                }
            });
        });
    </script>
@endsection
