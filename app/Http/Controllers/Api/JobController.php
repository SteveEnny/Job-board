<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResource;
use App\Http\Traits\CanLoadRelation;
use App\Http\Traits\ResponseTrait;
use App\Models\Job;
use Exception;
use Illuminate\Http\Request;

class JobController extends Controller
{
    use ResponseTrait, CanLoadRelation;
    /**
     * Display a listing of the resource.
     */
    private function getQueryvalue(string $value) : string | null{
        return request()->query($value);
    }
    public function index(Request $request)
    {
        try{
        

            $filters = $request->only('title', 'min_salary', 'max_salary', 'experience', 'category');
            // $job = Job::query()->filter();

            return new JobCollection($this->loadRelation(Job::query())->filter($filters)->paginate(5));
            }
             catch (Exception $exception) {
            logger($exception);
            return $this->badRequestResponse("Application error | {$exception->getMessage()}");
            }
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
    public function show(Job $job)
    {
       try{ // return $job;
        // return new JobResource($job);
        //load relation conditionally
        return new JobCollection([$this->loadRelation($job)]);}

        catch (\Exception $exception) {
            logger($exception);
            return $this->badRequestResponse("Application error | {$exception->getMessage()}");
            }

        // return new JobCollection([$job->load('employer.jobs')]);
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