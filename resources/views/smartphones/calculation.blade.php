@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="text-center mb-4">Proses Perhitungan SAW</h1>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>Matriks Keputusan Awal</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($criterias as $criteria)
                                <th>{{ ucfirst($criteria->name) }} ({{ $criteria->attribute }})</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($smartphones as $smartphone)
                            <tr>
                                <td><strong>{{ $smartphone->name }}</strong></td>
                                <td>{{ number_format($smartphone->price, 0) }}</td>
                                <td>{{ $smartphone->processor }}</td>
                                <td>{{ $smartphone->ram }}</td>
                                <td>{{ $smartphone->storage }}</td>
                                <td>{{ $smartphone->camera }}</td>
                                <td>{{ $smartphone->battery }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5>Nilai Maksimum dan Minimum</h5>
            </div>
            <div class="card-body">
                {{-- $maxMinValues is now passed from the controller --}}
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Kriteria</th>
                            <th>Nilai Maksimum</th>
                            <th>Nilai Minimum</th>
                            <th>Atribut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criterias as $criteria)
                            <tr>
                                <td>{{ ucfirst($criteria->name) }}</td>
                                <td>{{ number_format($maxMinValues[$criteria->name]['max'], 0, ',', '.') }}</td>
                                <td>{{ number_format($maxMinValues[$criteria->name]['min'], 0, ',', '.') }}</td>
                                <td>{{ $criteria->attribute }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5>Matriks Normalisasi</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($criterias as $criteria)
                                <th>{{ ucfirst($criteria->name) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($normalizedMatrix as $item)
                            <tr>
                                <td><strong>{{ $item['name'] }}</strong></td>
                                @foreach ($criterias as $criteria)
                                    <td>{{ number_format($item['normalized'][$criteria->name], 4) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5>Bobot Kriteria</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criterias as $criteria)
                            <tr>
                                <td>{{ ucfirst($criteria->name) }}</td>
                                <td>{{ $criteria->weight }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5>Matriks Normalisasi x Bobot Kriteria</h5>
                <p class="mb-0">Setiap nilai normalisasi dikalikan dengan bobot kriteria</p>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($criterias as $criteria)
                                <th>
                                    {{ ucfirst($criteria->name) }}
                                    <small class="d-block">(Bobot: {{ $criteria->weight }})</small>
                                </th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($weightedMatrix as $item)
                            <tr>
                                <td><strong>{{ $item['name'] }}</strong></td>
                                @foreach ($criterias as $criteria)
                                    <td>{{ number_format($item['weighted'][$criteria->name], 4) }}</td>
                                @endforeach
                                <td class="fw-bold">
                                    {{ number_format(array_sum($item['weighted']), 4) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5>Hasil Perankingan</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Rank</th>
                            <th>Nama Smartphone</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ranking as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ number_format($item['score'], 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('smartphones.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection
