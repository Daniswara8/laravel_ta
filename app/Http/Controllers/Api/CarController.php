<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return response()->json([
            'message' => 'Daftar mobil berhasil diambil',
            'data' => CarResource::collection($cars),
        ]);
    }

    public function show($id)
    {
        $car = Car::find($id);
        if (! $car) {
            return response()->json([
                'message' => 'Mobil tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'message' => 'Detail mobil berhasil diambil',
            'data' => new CarResource($car)
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'transmisi' => 'required|string|max:50',
            'bahan_bakar' => 'required|string|max:50',
            'status' => 'required|in:tersedia,terjual',
            'foto' => 'nullable|url|max:255',
        ]);

        $car = Car::create($validated);

        return response()->json([
            'message' => 'Data mobil berhasil dibuat',
            'data' => new CarResource($car)
        ], 201);
    }

    public function update (Request $request, $id) {
        $car = Car:: find($id);

        if(! $car) {
            return response()->json([
                'message' => 'Mobil tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'brand' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|integer|min:0',
            'tahun' => 'sometimes|required|integer|min:1900|max:' . (date('Y') + 1),
            'transmisi' => 'sometimes|required|string|max:50',
            'bahan_bakar' => 'sometimes|required|string|max:50',
            'status' => 'sometimes|required|in:tersedia,terjual',
            'foto' => 'sometimes|nullable|url|max:255',
        ]);

        $car->update($validated);

        return response()->json([
            'message' => 'Data mobil berhasil diperbarui',
            'data' => new CarResource($car)
        ]);
    }

    public function destroy($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'message' => 'Mobil tidak ditemukan',
            ], 404);
        }

        $car->delete();

        return response()->json([
            'message' => 'Mobil berhasil dihapus',
        ], 200);
    }
}
