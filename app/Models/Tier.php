<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tier extends Model
{
    protected $table = "tier";
    public $timestamps = true;

    protected $fillable = ['pledge', 'description'];

    /**
     * Returns the counts for each tier
     * @return mixed (an array of objects with tier_id & count as properties)
     */
    public static function getCounts()
    {
        $kvpArray = [];
        $tiers = DB::table('donation')
            ->select(
                DB::raw('tier_id, count(*) as count')
            )
            ->groupBy('tier_id')
            ->get();
        foreach ($tiers as $tier) {
            if ($tier->tier_id != null) {
                $kvpArray[$tier->tier_id] = (int)$tier->count;
            }
        }
        $allTiers = Tier::all();
        foreach ($allTiers as $tier) {
            if (!isset($kvpArray[$tier->id])) {
                $kvpArray[$tier->id] = 0;
            }
        }
        return $kvpArray;
    }


}
