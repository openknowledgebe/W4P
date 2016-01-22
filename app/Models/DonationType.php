<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class DonationType extends Model
{
    protected $table = "donation_type";
    public $timestamps = true;
    protected $fillable = [
        "name",
        "description",
        "unit_description",
        "required_amount",
        "kind"
    ];
}
