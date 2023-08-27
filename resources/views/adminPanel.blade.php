@extends('layout')
@section('title', "Admin Panel")
@section('content')
@if(session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
@elseif (session()->has('success'))
<div class="alert alert-danger">{{ session('success') }}</div>
@endif
    @forelse ($cars as $car)
        <div class="card mt- mb-3" style="max-width: 700px;">
            <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $car->photo_url }}" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">{{ $car->nome_veiculo }}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Ano: {{ $car->ano }}</li>
                    <li class="list-group-item">Câmbio: {{ $car->cambio }}</li>
                    <li class="list-group-item">Combustível: {{ $car->combustivel }}</li>
                    <li class="list-group-item">Cor: {{ $car->cor }}</li>
                    <li class="list-group-item">Portas: {{ $car->portas }}</li>
                    <li class="list-group-item">Quilometragem: {{ $car->quilometragem }}</li>
                </ul>
                <a href="{{ $car->link }}" target="_blank">
                    <button class="btn btn-primary">Ver página</button>
                </a>
                <a href="{{ route('admin.delete' , ['car_id' => $car->id]) }}">
                    <button type="button" class="btn btn-danger">Deletar</button>
                </a>
                </div>
            </div>
            </div>
        </div>
    @empty
    <div class="container">
     <h1>Nenhum cadastro no banco de dados</h1>
    </div>
    @endforelse
@endsection