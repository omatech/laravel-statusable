<?php

namespace Omatech\LaravelStatusable\App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = [
        'name'
    ];
}
