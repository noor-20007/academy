<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationRequest extends Model
{
    protected $fillable = ['name', 'mobile', 'email', 'age', 'course_id', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
