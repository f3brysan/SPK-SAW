@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h2>Detail Smartphone</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h3>{{ $smartphone->name }}</h3>
                    <p><strong>Merek:</strong> {{ $smartphone->brand }}</p>
                    <p><strong>Harga:</strong> Rp {{ number_format($smartphone->price, 0, ',', '.') }}</p>
                    <p><strong>Processor:</strong> {{ $smartphone->processor }} GHz</p>
                    <p><strong>RAM:</strong> {{ $smartphone->ram }} GB</p>
                    <p><strong>Storage:</strong> {{ $smartphone->storage }} GB</p>
                    <p><strong>Kamera:</strong> {{ $smartphone->camera }} MP</p>
                    <p><strong>Baterai:</strong> {{ $smartphone->battery }} mAh</p>
                </div>
            </div>
            <a href="{{ route('smartphones.index') }}" class="btn btn-primary mt-3">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection