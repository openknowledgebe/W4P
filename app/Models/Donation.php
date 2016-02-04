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
        "payment_id",
        "payment_status",
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

    public function donationContents()
    {
        $donationItemsGroups = DonationItem::where('donation_id', $this->id)
            ->get()->groupBy('donation_type_id')->toArray();
        $donationTypes = DonationType::all();

        // KVP for types
        $types = [];
        foreach ($donationTypes as $type) {
            $types[$type->id] = [
                "kind" => $type->kind,
                "name" => $type->name
            ];
        }

        // Get all kinds
        $donationKinds = DonationKind::all();

        // Total counts
        $donationCounts = [];

        // For each kind (manpower, etc)
        foreach ($donationKinds as $kind) {
            // Build a set of items (subcategories per kind)
            $items = [];

            // Loop over all donationItemGroups
            foreach (array_keys($donationItemsGroups) as $array_key) {
                if ($types[$array_key]["kind"] == $kind) {
                    array_push($items, [
                        "name" => $types[$array_key]["name"],
                        "count" => count($donationItemsGroups[$array_key])
                    ]);
                }
            }
            if (count($items) > 0) {
                $donationCounts[$kind] = $items;
            }
        }

        return $donationCounts;
    }
}
