@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Müşteri Ekleme</h2>

    <div class="d-flex justify-content-center">
        <form action="{{ route('customers.store') }}" method="POST" class="w-100" style="max-width: 800px;">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3 row justify-content-center">
                <label for="name" class="col-sm-2 col-form-label">Müşteri Adı</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="address" class="col-sm-2 col-form-label">Adres</label>
                <div class="col-sm-6">
                    <input type="text" name="address" class="form-control" id="address" required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="phone" class="col-sm-2 col-form-label">Telefon</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" class="form-control" id="phone" required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <button class="btn btn-primary" >Kaydet</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection