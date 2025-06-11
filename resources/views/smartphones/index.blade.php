@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Sistem Pendukung Keputusan Pemilihan Smartphone</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>Daftar Smartphone</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Merek</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($smartphones as $key => $smartphone)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $smartphone->name }}</td>
                                <td>{{ $smartphone->brand }}</td>
                                <td>
                                    <a href="{{ route('smartphones.show', $smartphone->id) }}" class="btn btn-sm btn-info">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5>Hasil Perankingan SAW</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama</th>
                                <th>Merek</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ranking as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['brand'] }}</td>
                                <td>{{ number_format($item['score'], 4) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-end mb-3">
    <a href="{{ route('smartphones.calculation') }}" class="btn btn-info">
        <i class="fas fa-calculator"></i> Lihat Proses Perhitungan
    </a>
</div>
        </div>
    </div>
</div>

@endsection