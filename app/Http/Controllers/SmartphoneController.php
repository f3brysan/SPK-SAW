<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Smartphone;
use Illuminate\Http\Request;

class SmartphoneController extends Controller
{
    public function index()
    {
        $smartphones = Smartphone::all();
        $criterias = Criteria::all();

        // Hitung SAW
        $ranking = $this->calculateSAW($smartphones, $criterias);

        return view('smartphones.index', compact('smartphones', 'ranking'));
    }

    public function show(Smartphone $smartphone)
    {
        return view('smartphones.show', compact('smartphone'));
    }

    private function calculateSAW($smartphones, $criterias)
    {
        // Normalisasi matriks
        $normalized = $this->normalizeMatrix($smartphones, $criterias);

        // Hitung nilai preferensi
        $ranking = [];
        foreach ($normalized as $item) {
            $total = 0;
            foreach ($criterias as $criteria) {
                $total += $item['normalized'][$criteria->name] * $criteria->weight;
            }

            $ranking[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'brand' => $item['brand'],
                'score' => $total
            ];
        }

        // Urutkan dari nilai tertinggi
        usort($ranking, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $ranking;
    }

    private function normalizeMatrix($smartphones, $criterias)
    {
        // Cari nilai max dan min untuk setiap kriteria
        $maxMin = [];
        foreach ($criterias as $criteria) {
            $values = $smartphones->pluck($criteria->name)->toArray();
            $maxMin[$criteria->name] = [
                'max' => max($values),
                'min' => min($values),
                'attribute' => $criteria->attribute
            ];
        }

        // Normalisasi
        $normalized = [];
        foreach ($smartphones as $smartphone) {
            $norm = [];
            foreach ($criterias as $criteria) {
                $value = $smartphone->{$criteria->name};

                if ($criteria->attribute == 'benefit') {
                    $norm[$criteria->name] = $value / $maxMin[$criteria->name]['max'];
                } else {
                    $norm[$criteria->name] = $maxMin[$criteria->name]['min'] / $value;
                }
            }

            $normalized[] = [
                'id' => $smartphone->id,
                'name' => $smartphone->name,
                'brand' => $smartphone->brand,
                'normalized' => $norm
            ];
        }

        return $normalized;
    }

    public function showCalculation()
    {
        $smartphones = Smartphone::all();
        $criterias = Criteria::all();

        $normalizedMatrix = $this->normalizeMatrix($smartphones, $criterias);
        $weightedMatrix = $this->calculateWeightedMatrix($normalizedMatrix, $criterias);
        $ranking = $this->calculateSAW($smartphones, $criterias);

        return view('smartphones.calculation', [
            'smartphones' => $smartphones,
            'criterias' => $criterias,
            'normalizedMatrix' => $normalizedMatrix,
            'weightedMatrix' => $weightedMatrix,
            'ranking' => $ranking,
            'maxMinValues' => $this->getMaxMinValues($smartphones, $criterias)
        ]);
    }

    private function calculateWeightedMatrix($normalizedMatrix, $criterias)
    {
        $weighted = [];

        foreach ($normalizedMatrix as $item) {
            $weightedRow = [
                'id' => $item['id'],
                'name' => $item['name'],
                'brand' => $item['brand'],
                'weighted' => []
            ];

            foreach ($criterias as $criteria) {
                $weightedRow['weighted'][$criteria->name] =
                    $item['normalized'][$criteria->name] * $criteria->weight;
            }

            $weighted[] = $weightedRow;
        }

        return $weighted;
    }

    private function getMaxMinValues($smartphones, $criterias)
    {
        $maxMin = [];
        foreach ($criterias as $criteria) {
            $values = $smartphones->pluck($criteria->name)->toArray();
            $maxMin[$criteria->name] = [
                'max' => max($values),
                'min' => min($values),
                'attribute' => $criteria->attribute
            ];
        }
        return $maxMin;
    }
}
