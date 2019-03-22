<?php

namespace Omatech\LaravelStatusable\App\Models;

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
            $add->user_id = auth()->guard($guard)->user()->id;
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
}
