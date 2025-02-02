<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if (Storage::disk('local')->exists('data.json')) {
            $json = Storage::disk('local')->get('data.json');
            $data = json_decode($json, true);
            $data = collect($data)->sortBy('name')->values()->all(); 
        }else{
            $data = [];
        }


        
        return view('index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $allData = [];
        if (Storage::disk('local')->exists('data.json')) {
            $json = Storage::disk('local')->get('data.json');
            $data = json_decode($json, true);
            $allData = collect($data)->sortBy('name')->values()->all(); 
        }

        $newData = $request->all();
        $newData['created_at'] = date('Y-m-d H:i:s');
        
        $allData[] = $newData;
        // Convert to JSON and save
        Storage::disk('local')->put('data.json', json_encode($allData, JSON_PRETTY_PRINT));

        $result['message'] = "Product added";
        $result['code'] = 200;

        return response()->json($result, $result['code']);
        
    }}
