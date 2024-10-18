<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // view all job-application
        //employer can view all job applicaton
    }


  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize('apply', $job);
        $request->validate([
            'expected_salary' => 'required | min:1 |max:1000000',
        ]);
        $job->jobApplications()->create([
            'job_id' => $job->id,
            // 'user_id' => auth()->user()->id(),
            'user_id' => request()->user()->id,
            ...$request->only('expected_salary'),
        ]);
        return $this->successResponse("Job application successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        // edit-user-job-application
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}