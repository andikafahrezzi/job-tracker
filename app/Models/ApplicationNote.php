<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Application;

class ApplicationNote extends Model
{
    protected $fillable = ['application_id', 'content'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
