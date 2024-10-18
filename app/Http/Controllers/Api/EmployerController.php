<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class EmployerController extends Controller
{

    use ResponseTrait;
    public function allJobApplication(){
        $employer = request()->user()->employer()->first();
        // $employer_job = $employer->jobs()->get();

        $employer_jobs = Job::where('employer_id',$employer->id)->get();
        return response()->json([
            'data' => $employer_jobs,
        ]);
        // return $this->successResponse('success', $employer_jobs);
        
    }

    public function jobApplicate(string $jobId) {
        $jobApplicate = JobApplication::where('job_id', $jobId)->get();
        return response()->json([
            'data' => $jobApplicate,
        ]);
    }
}