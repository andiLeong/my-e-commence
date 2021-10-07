<?php


namespace App\Models;


trait TimeFrameScopes
{

//    public function scopeLastThirtyDays($query)
//    {
//        return $query->where('created_at', '>=', now()->subDays(30));
//    }

    public function scopeBeforeLastThirtyDays($query)
    {
        return $query->where('created_at', '<', now()->subDays(30));
    }

    public function scopeBeforeLastThirtyDaysRaw($query)
    {
//        sleep(1);
        $thirtyDays = now()->subDays(30);
        return $query->selectRaw("count(case when created_at < '$thirtyDays' then 1 end) as before_thirty_day_count");
    }
}
