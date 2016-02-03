<?php

return array(

    // Donation intro page
    "title" => "How do you want to support this project?",
    "description" => "You can support this project in a few ways. The following options below are available to pledge:",

    // Info about money
    "money_pledge" => "You're donating the following amount:",

    // Confirmation page

    "confirm" => [
        "title" => "Confirm your information",
        "description" => "We will need some additional information about you for our records. You will receive an email containing a confirmation link and a private backer link after donating."
    ],

    // Form field

    "user" => [
        "first_name" => [
            "title" => "First name",
            "placeholder" => "e.g. John",
            "info" => "You must enter a first name."

        ],
        "last_name" => [
            "title" => "Last name",
            "placeholder" => "e.g. Doe",
            "info" => "You must enter a last name."
        ],
        "email" => [
            "title" => "Email",
            "placeholder" => "e.g. johndoe@w4p.com",
            "info" => "You must enter a valid email address."
        ],
        "message" => [
            "title" => "Message for project creator",
            "placeholder" => "You can leave an optional message to the project creator here.",
            "info" => "This message is optional."
        ],
    ],

    "buttons" => [
        "confirm" => "Donate!"
    ],

    // No donation options available
    "no_donation_options" => [
        "title" => "No donation options available",
        "description" => "There are no donation options available. The project creator needs to set up goals first before you can pledge anything."
    ],

    // Donation thank you message

    "thanks" => [
        "title" => "Thanks!",
        "description" => "Thank you for your donation. We have sent you an email. Unless you have donated money, you will still need to confirm this donation."
    ],

    "confirmed" => [
        "title" => "Thanks!",
        "description" => "You have successfully confirmed your donation. The project creator may get in touch with you to organise some further details."
    ],

    // Actual error messages for input
    "errors" => [
        "no_donations_made" => "You must pledge at least 1 unit or money (if this project has a monetary goal).",
        "donations_invalid" => "You have entered an invalid number of donations. Please enter a correct count."
    ]
);