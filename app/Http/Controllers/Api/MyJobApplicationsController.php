<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;

class MyJobApplicationsController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job_applications = request()->user()->jobApplications()->with('job', 'job-employer')->latest()->get();
        return $this->successResponse('Success', $job_applications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        // 1. get the particaular job to edit on the table
        // 2. edit the particaular job.
        $jobAppliedTo = $request->user()->jobApplications()->where('id', $id);
        // edit job applied to
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}