<?php

namespace Omatech\LaravelStatusable\App\Traits;

use Omatech\LaravelStatusable\App\Models\StatusHistory;

trait Statusable
{
    public function status()
    {
        return $this->morphOne(StatusHistory::class, 'model')
            ->join('status', 'status.id', '=', 'status_history.status_id')
            ->with(['related'])
            ->orderBy('status.level', 'desc')
            ->orderBy('status_history.created_at', 'desc');
    }

    public function statusHistory()
    {
        return $this->morphMany(StatusHistory::class, 'model')
            ->with(['status', 'related'])
            ->orderBy('created_at', 'desc');
    }

    public function statusHistoryLevel()
    {
        return $this->morphMany(StatusHistory::class, 'model')
            ->with(['status'])
            ->orderBy('created_at', 'desc');
    }

    public function getStatusAttribute()
    {
        $status = $this->status()->first();

        if ($status) {
            return __($status->key);
        }

        return null;
    }

    public function getStatusLevelAttribute()
    {
        $status = $this->status()->first();

        if ($status) {
            return $status->level;
        }

        return null;
    }

    public function getShortStatusAttribute()
    {
        $status = $this->status()->first();

        if ($status) {
            return __($status->short_key);
        }

        return null;
    }

    public function getStatusHistoryAttribute()
    {
        return $this->statusHistory()->get() ?? [];
    }
}
