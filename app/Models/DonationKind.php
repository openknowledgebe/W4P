<?php

namespace W4P\Models;

class DonationKind
{
    public static function all()
    {
        return ['manpower', 'material', 'coaching', 'currency'];
    }

    /**
     * Get all percentages (Based on DonationKind string)
     * @return array
     */
    public static function getAllPercentages($donationQuery = null)
    {
        if ($donationQuery == null) {
            $donationQuery = Donation::whereNotNull('confirmed')->get();
        }
        $kinds = [];
        $donationIds = $donationQuery->pluck('id', null)->toArray();
        foreach (self::all() as $kind) {
            $subitems = [];
            // Get the types (created by admins)
            $types = DonationType::where('kind', $kind)->get();
            foreach ($types as $type) {
                // Get the count of donation items provided by users
                $total = DonationItem::where('donation_type_id', $type->id)
                    ->whereIn('donation_id', $donationIds)
                    ->count();
                $goal = (int)$type->required_amount;
                $percentage = $total / $goal;
                // Push subitems
                array_push($subitems, [
                    "total" => $total,
                    "goal" => $goal,
                    "reached" => $percentage // total = 1, 100% = 1
                ]);
            }

            // Calculate the general percentage
            if (count($subitems) > 0) {
                // Assume the weight is divided equally
                $defaultWeight = (1 / (int)count($subitems));
                $percentage = 0;
                // Calculate the sum of all subitems' percentages
                foreach ($subitems as $subitem) {
                    $percentage = $percentage + ($subitem["reached"] * $defaultWeight);
                }
            } else {
                // If no subitems, assume 0% complete since there is no goal
                $percentage = 0;
            }
            $kinds[$kind] = [
                "percentage" => round($percentage * 100, 2),
                "items" => $subitems
            ];
        }
        return $kinds;
    }
}