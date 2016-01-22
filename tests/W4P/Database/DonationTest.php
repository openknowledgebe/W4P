<?php

/**
 * @author Nico Verbruggen
 * @copyright 2015 Underlined bvba
 * @link https://underlined.be
 */

use W4P\Models\Donation;
use W4P\Models\DonationItem;
use W4P\Models\DonationType;

class DonationTest extends TestCase
{
    public function testDatabaseRelationships()
    {
        // Create a new type of donation
        $createdDonationType = DonationType::create([
            "name" => "Freelancers",
            "description" => "We are looking for freelancers who are willing to provide their services, free of charge.",
            "unit_description" => "One 7,6 hour day of tutelage.",
            "required_amount" => 5,
            "kind" => "coaching"
        ]);

        // Create a new donation
        $createdDonation = Donation::create([
            "first_name" => "John",
            "last_name" => "Doe",
            "email" => "john.doe@w4p.be",
            "currency" => 0,
        ]);

        // Create a donation item
        $createdDonationItem = DonationItem::create([
            "donation_id" => $createdDonation->id,
            "donation_type_id" => $createdDonationType->id
        ]);

        $donation = Donation::all()->load('donationItems', 'donationItems.donationType')->toArray()[0];

        // Expected structure
        $this->assertArrayHasKey("id", $donation);
        $this->assertArrayHasKey("first_name", $donation);
        $this->assertArrayHasKey("last_name", $donation);
        $this->assertArrayHasKey("email", $donation);
        $this->assertArrayHasKey("currency", $donation);
        $this->assertArrayHasKey("donation_items", $donation);

        $donation_item = $donation["donation_items"][0];
        $this->assertArrayHasKey("id", $donation_item);
        $this->assertArrayHasKey("donation_id", $donation_item);
        $this->assertArrayHasKey("donation_type_id", $donation_item);
        $this->assertArrayHasKey("donation_type", $donation_item);

        $donation_type = $donation_item["donation_type"];
        $this->assertArrayHasKey("id", $donation_type);
        $this->assertArrayHasKey("name", $donation_type);
        $this->assertArrayHasKey("description", $donation_type);
        $this->assertArrayHasKey("unit_description", $donation_type);
        $this->assertArrayHasKey("required_amount", $donation_type);
        $this->assertArrayHasKey("kind", $donation_type);
    }
}
