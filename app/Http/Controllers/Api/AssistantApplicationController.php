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
        $applications = AssistantApplication::all();

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $applications
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:255',
            'student_id' => 'required|string|unique:assistant_applications,student_id',
            'course_name' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:0,4.00',
            'status' => 'nullable|in:pending,accepted,rejected',
        ], [
            'student_name.required' => 'Nama mahasiswa wajib diisi',
            'student_name.string' => 'Nama mahasiswa harus berupa teks',
            'student_name.max' => 'Nama mahasiswa maksimal 255 karakter',
            'student_id.required' => 'NIM wajib diisi',
            'student_id.unique' => 'NIM sudah terdaftar',
            'course_name.required' => 'Nama mata kuliah wajib diisi',
            'course_name.string' => 'Nama mata kuliah harus berupa teks',
            'gpa.required' => 'IPK wajib diisi',
            'gpa.numeric' => 'IPK harus berupa angka',
            'gpa.between' => 'IPK harus antara 0 - 4.00',
            'status.in' => 'Status harus pending, accepted, atau rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $application = AssistantApplication::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Application created successfully',
            'data' => $application
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AssistantApplication $application)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $application
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssistantApplication $application)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'sometimes|required|string|max:255',
            'student_id' => 'sometimes|required|string|unique:assistant_applications,student_id,' . $application->id,
            'course_name' => 'sometimes|required|string|max:255',
            'gpa' => 'sometimes|required|numeric|between:0,4.00',
            'status' => 'sometimes|required|in:pending,accepted,rejected',
        ], [
            'student_name.required' => 'Nama mahasiswa wajib diisi',
            'student_name.string' => 'Nama mahasiswa harus berupa teks',
            'student_name.max' => 'Nama mahasiswa maksimal 255 karakter',
            'student_id.required' => 'NIM wajib diisi',
            'student_id.unique' => 'NIM sudah terdaftar',
            'course_name.required' => 'Nama mata kuliah wajib diisi',
            'course_name.string' => 'Nama mata kuliah harus berupa teks',
            'gpa.required' => 'IPK wajib diisi',
            'gpa.numeric' => 'IPK harus berupa angka',
            'gpa.between' => 'IPK harus antara 0 - 4.00',
            'status.in' => 'Status harus pending, accepted, atau rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $application->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Application updated successfully',
            'data' => $application
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssistantApplication $application)
    {
        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Application deleted successfully',
            'data' => null
        ], 200);
    }
}
