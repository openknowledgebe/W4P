<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $table = "donation";
    public $timestamps = true;
    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "currency",
        "secret_url",
        "confirm_url",
        "confirmed",
        "message"
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'confirmed'];

    public function donationItems()
    {
        return $this->hasMany(
            'W4P\Models\DonationItem',
            'donation_id',
            'id'
        );
    }
}
