<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssistantApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssistantApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(AssistantApplication::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string',
            'student_id' => 'required|unique:assistant_applications',
            'course_name' => 'required|string',
            'gpa' => 'required|numeric|between:0,4.00',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $application = AssistantApplication::create($request->all());

        return response()->json($application, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AssistantApplication $application)
    {
        return response()->json($application);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssistantApplication $application)
    {
        $application->update($request->all());

        return response()->json($application);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssistantApplication $application)
    {
        $application->delete();

        return response()->json(null, 204);
    }
}
