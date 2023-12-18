<?php

namespace App\Http\Controllers;

use App\Http\Requests\TambahData;
use App\Http\Requests\UbahData;
use App\Http\Resources\BarangCollection;
use App\Http\Resources\BarangResource;
use App\Models\Item;
use Exception;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $itemdata = Item::all();
            $formattedDatas = new BarangCollection($itemdata);
            return response()->json([
                "message" => "succes",
                "data" => $formattedDatas
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TambahData $request)
    {
        $validatedRequest = $request->validated();
        try {
            $itemdata = Item::create($validatedRequest);
            $formattedDatas = new BarangResource($itemdata);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas,
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $itemdata = Item::findOrFail($id);
            $formattedDatas = new BarangResource($itemdata);
            return response()->json([
                "message" => "success",
                "data" => $formattedDatas
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UbahData $request, string $id)
    {
        $validatedRequest = $request->validated();
        
        try {
            $itemdata = Item::findOrFail($id);  
            $itemdata->update($validatedRequest);
            $formattedDatas = new BarangResource($itemdata);
            return response()->json([
            "message" => "success",
            "data" => $formattedDatas,
            ],200);
            
            
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $itemdata = Item::findOrFail($id);
            $itemdata->delete();
            $formattedDatas = new BarangResource($itemdata);
            return response()->json([
                "message" => "succes",
                "data" => $formattedDatas
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

}
