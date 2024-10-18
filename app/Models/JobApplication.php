<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JobApplication extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['expected_salary', 'user_id', 'job_id'];

    public function jobs(): BelongsTo {
        return $this->belongsTo(Job::class);
    }

    public function user() :BelongsTo {
        return $this->belongsTo(User::class);
    }
}