<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory, HasUuids;

    public function employer() : BelongsTo {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany {
        return $this->hasMany(JobApplication::class);
    }
    
    public function hasUserApplied(Authenticatable |User | int $user){
        // 1. getting a job with the id of this current job model. i.e it does'nt know the current job get with the id  
        // ie. Job::where('id', Job->id)
        // 2. check jobs application under this job
        // 3. check if the user_id is present in the job application table


        return $this->where('id', $this->id)
        ->whereHas('jobApplications', fn($query) => $query->where('user_id', '=' ,$user->id ?? $user))->exists();
    }


    public static array $experience = ['entry', 'intermediate', 'senior'];

    public static array $category = ['IT', 'Finance', 'Sales', 'Marketing'];

    public function scopeFilter(Builder | QueryBuilder $query, array $filters) : Builder | QueryBuilder {
        return $query->when($filters['title'] ?? null, function ($query, $title) {
            $query->where('title', 'like', '%' . $title . '%');
        })->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
            $query->where('salary', '>=', $minSalary);
        })->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
            $query->where('salary', '<=', $maxSalary);
        })->when($filters['experience'] ?? null, function ($query, $experience) {
            $query->where('experience', $experience);
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category', $category);
        });
    }
}