<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ApplicationNote;

class Application extends Model
{
    protected $fillable = [
        'company_name',
        'position',
        'salary_estimation',
        'status',
        'interview_at',
    ];
    protected $casts = [
        'interview_at' => 'datetime',
    ];

    // RELASI BALIK KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function notes()
    {
        return $this->hasMany(ApplicationNote::class);
    }
}
