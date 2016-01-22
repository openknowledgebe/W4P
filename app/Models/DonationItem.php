<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class DonationItem extends Model
{
    protected $table = "donation_item";
    public $timestamps = true;
    protected $fillable = [
        "donation_id",
        "donation_type_id",
    ];

    public function donation()
    {
        return $this->belongsTo(
            'W4P\Models\Donation',
            'id',
            'donation_id'
        );
    }

    public function donationType()
    {
        return $this->hasOne(
            'W4P\Models\DonationType',
            'id',
            'donation_type_id'
        );
    }
}
