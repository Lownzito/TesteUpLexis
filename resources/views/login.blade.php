@extends('layout')
@section('title', 'Login')
@section('content')
<div class="container">
    @if ($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{route('login.do')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 600px ">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="password" class="form-control">
        </div>
            <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection