<?php

namespace Omatech\LaravelStatusable\App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $table = 'status_history';

    public static function add(String $name, Model $model, Model $related_model = null, String $guard = null)
    {
        $status = Status::firstOrCreate(['name' => $name]);
        $add = new self;
        $add->status_id = $status->id;
        $add->model_type = get_class($model);
        $add->model_id = $model->id;

        if ($guard) {
            $add->user_id = auth()->guard($guard)->user()->id ?? 0;
            $add->guard = $guard;
        }

        if ($related_model) {
            $add->related_model_type = get_class($related_model);
            $add->related_model_id = $related_model->id;
        }

        $add->save();
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function related()
    {
        return $this->morphTo(null, 'related_model_type', 'related_model_id');
    }

    public function dateTime($format)
    {
        return Carbon::parse($this->attributes['created_at'])->format($format);
    }
}
