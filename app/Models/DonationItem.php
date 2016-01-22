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
}
