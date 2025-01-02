<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController;
use App\Models\Disease;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiseaseController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Disease::all();
        return response()->json([
            'success' => true,
            'message' => 'Get Data Disease Sucessfull',
            'data' => $result,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'name' => 'required|max:255',
            'symptoms' => 'required',
            'treatment' => 'required',
        ];
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Adding Data Disease Failed',
                'data' => ['errors' => $validator->errors()],
            ], 400);
        } else {
            $result = Disease::create([
                'name' => $input['name'],
                'symptoms' => $input['symptoms'],
                'treatment' => $input['treatment'],
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Adding Data Disease Sucessfull',
                'data' => $result,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Disease::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Get Data Disease By ID '.$id.' Sucessfull',
            'data' => $result,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $input['id'] = $id;
        $rules = [
            'id' => 'required|exists:diseases',
            'name' => 'required|max:255',
            'symptoms' => 'required',
            'treatment' => 'required',
        ];
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Update Data Disease Failed',
                'data' => ['errors' => $validator->errors()],
            ], 400);
        } else {
            $result = Disease::where('id','=',$id)->update([
                'name' => $input['name'],
                'symptoms' => $input['symptoms'],
                'treatment' => $input['treatment'],
            ]);
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Update Data Disease Sucessfull',
                    'data' => $input,
                ], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rules = [
            'id' => 'required|exists:diseases',
        ];
        $validator = Validator::make(array('id' => $id), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Delete Data Disease Failed',
                'data' => ['errors' => $validator->errors()],
            ], 400);
        } else {
            $result = Disease::destroy($id);
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Delete Data Disease Sucessfull',
                    'data' => $result,
                ], 200);
            }
        }
    }
}
