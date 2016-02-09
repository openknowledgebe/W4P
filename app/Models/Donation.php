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
        "tier_id",
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

    /**
     * @return array
     */
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

    /**
     * Automatically assigns this donation to the
     * correct and relevant tier
     * For performance reasons, recommended use is
     * when a _single_ donation needs assignment
     * Otherwise, use :reassignAllTiers()
     */
    public function assignToTier()
    {
        $tiers = Tier::all()->sortBy('pledge')->values();
        self::assignTier($this, $tiers);
    }

    /**
     * Automatically reassigns all tiers
     */
    public static function reassignAllTiers()
    {
        $tiers = Tier::all()->sortBy('pledge')->values();
        $donations = Donation::all();

        foreach ($donations as $donation) {
            self::assignTier($donation, $tiers);
        }
    }

    /**
     * Assigns a donation to the appropriate tier
     * @param $donation
     * @param $tiers
     */
    private static function assignTier($donation, $tiers)
    {
        $donation->tier_id = null;
        $donation->save();
        if (count($tiers) > 0) {
            for ($i = 0; $i < count($tiers); $i++) {
                if ($tiers[$i]->pledge <= $donation->currency) {
                    $donation->tier_id = $tiers[$i]->id;
                }
            }
        }
        if ($donation->confirmed != null) {
            $donation->save();
        }
    }
}
