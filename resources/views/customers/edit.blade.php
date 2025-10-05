@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Müşteri Düzenleme</h2>

    <div class="d-flex justify-content-center">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="w-100" style="max-width: 800px;">
            @csrf
            @method('PUT')

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
                    <input type="text" name="name" class="form-control" value="{{ $customer->name }}" id="name" required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="address" class="col-sm-2 col-form-label">Adres</label>
                <div class="col-sm-6">
                    <input type="text" name="address" class="form-control" value="{{ $customer->address }}" id="address" required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="phone" class="col-sm-2 col-form-label">Telefon</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" id="phone" required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" value="{{ $customer->email }}" id="email" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <button class="btn btn-success" >Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
