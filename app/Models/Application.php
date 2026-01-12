<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Application extends Model
{
    protected $fillable = [
        'company_name',
        'position',
        'salary_estimation',
        'status',
    ];

    // RELASI BALIK KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
