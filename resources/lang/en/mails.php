<?php
return [
    "donation_confirm" => [
        "subject" => "Confirm your donation",
        "teaser" => "Your donation has been registered, but it has not been confirmed yet.",
        "content" => [
            "header" => "Please confirm your donation",
            "intro" => "Hello there, :name.<br/>We have successfully received your donation registration for <strong>:project</strong>. As a part of the donation system, we require donors to confirm their pledge before it is officially counted as collected.<br/> You have pledged the following:",
            "confirm" => "In order to confirm this donation, you can click the following link below:",
            "confirm_action" => "Confirm this donation"
        ],
    ],

    "donation_success" => [
        "subject" => "Donation confirmed!",
        "teaser" => "Your donation has been confirmed.",
        "content" => [
            "header" => "Thanks!",
            "intro" => "Hello there, :name.<br/>We have successfully received your donation confirmation for <strong>:project</strong>.",
            "confirm" => "In order to view your pledge and your rewards, you can click the following link below:",
            "confirm_action" => "View my pledge"
        ],
    ],

    "donation_money_success" => [
        "subject" => "Paid for donation!",
        "teaser" => "Your payment has been completed.",
        "content" => [
            "header" => "Thank your for your donation!",
            "intro" => "Hello there, :name.<br/>We have successfully received your donation payment (€:amount) for <strong>:project</strong>.",
            "additional_pledge" => "In addition to this, you have also pledged the following:",
            "additional_pledge_disclaimer" => "Since you already paid for your donation, your pledge was automatically confirmed. The project creator might get in touch with you regarding the items above.",
            "confirm" => "In order to view your pledge and your rewards, you can click the following link below:",
            "confirm_action" => "View my pledge"
        ],
    ]
];