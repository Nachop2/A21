<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Modulos = Modulo::latest()->get();
        
        if (is_null($Modulos->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No Modulo found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Modulos are retrieved successfully.',
            'data' => $Modulos,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'description' => 'required|string|'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $Modulo = Modulo::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Modulo is added successfully.',
            'data' => $Modulo,
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Modulo = Modulo::find($id);
  
        if (is_null($Modulo)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Modulo is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Modulo is retrieved successfully.',
            'data' => $Modulo,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $Modulo = Modulo::find($id);

        if (is_null($Modulo)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Modulo is not found!',
            ], 200);
        }

        $Modulo->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Modulo is updated successfully.',
            'data' => $Modulo,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Modulo = Modulo::find($id);
  
        if (is_null($Modulo)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Modulo is not found!',
            ], 200);
        }

        Modulo::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Modulo is deleted successfully.'
            ], 200);
    }

    /**
     * Search by a Modulo name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $Modulos = Modulo::where('name', 'like', '%'.$name.'%')
            ->latest()->get();

        if (is_null($Modulos->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No Modulo found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Modulos are retrieved successfully.',
            'data' => $Modulos,
        ];

        return response()->json($response, 200);
    }
}
