<?php

return array(

    // Donation intro page
    "title" => "Hoe wil je dit project steunen?",
    "description" => "Je kan dit project op een aantal manieren steunen. De volgende opties zijn beschikbaar:",

    // Donation info page
    "your_donation" => "Uw donatie:",
    "personal_data" => "Persoonlijke data",
    "your_details" => "Uw details",
    "message" => "Uw bericht",
    "tier" => "Uw donatie-rang",
    "select_tier" => "Kies een donatie-rang",
    "or_custom_amount" => "of vul een eigen bedrag in:",
    "unit" => "eenheid",

    // Mollie: about
    "donation_for" => "Donatie for",

    // Info about money
    "money_pledge" => "U doneert het volgende bedrag:",
    "you_pledged" => "U belooft het volgende:",

    // Payment statuses
    "payment_status" => [
        "paid" => "Betaald",
        "pending" => "Afwachten",
        "refunded" => "Terugbetaald",
        "chargedback" => "Chargeback",
        "cancelled" => "Geannulleerd",
        "expired" => "Verlopen",
        "completed" => "Afgerond"
    ],
    "payment_status_page" => [
        "title" => "Uw betaling",
        "description" => "De huidige status van uw betaling is: <strong>:status</strong>.",
    ],

    // Confirmation page
    "confirm" => [
        "title" => "Bevestig uw informatie",
        "description" => "We zullen nog extra informatie nodig hebben. U ontvangt binnenkort een e-mail met een bevestigingslink en een privélink na het doneren."
    ],

    // Form field
    "user" => [
        "first_name" => [
            "title" => "Voornaam",
            "placeholder" => "bv. John",
            "info" => "U moet een voornaam invullen."

        ],
        "last_name" => [
            "title" => "Achternaam",
            "placeholder" => "bv. Doe",
            "info" => "U moet een achternaam invullen."
        ],
        "email" => [
            "title" => "E-mailadres",
            "placeholder" => "bv. johndoe@w4p.com",
            "info" => "U moet een geldig e-mailadres invullen."
        ],
        "message" => [
            "title" => "Bericht voor organisatie",
            "placeholder" => "U kunt een optioneel bericht achterlaten voor de makers van dit project.",
            "info" => "Dit bericht is optioneel. U kunt dit leeg laten."
        ],
    ],

    "buttons" => [
        "confirm" => "Doneer!"
    ],

    // No donation options available
    "no_donation_options" => [
        "title" => "Geen donatie-opties beschikbaar.",
        "description" => "Er zijn geen donatie-opties beschikbaar. De makers van dit project moeten dit eerst instellen voordat er iets te zien valt."
    ],

    // Donation thank you message

    "thanks" => [
        "title" => "Bedankt voor uw donatie!",
        "title_paid" => "Bedankt voor uw betaling!",
        "description" => "<p>Bedankt voor uw donatie. We hebben u een mail gestuurd met de status van uw donatie.</p>
    <p>U zult een email krijgen met een donatielink. U zult deze donatie moeten bevestigen door op de link in de email te klikken voordat uw donatie definitief bevestigd is.</p>"
    ],

    "confirmed" => [
        "title" => "Bedankt!",
        "description" => "Bedankt. Uw donatie is succesvol bevestigd. De makers van dit project nemen mogelijk contact met u op om nog enkele zaken te regelen."
    ],

    // Actual error messages for input
    "errors" => [
        "no_donations_made" => "U moet minstens 1 eenheid kiezen of een bedrag doneren (als dit project een monetair doel heeft).",
        "donations_invalid" => "U heeft een ongeldig aantal donaties ingevuld. Gelieve een correct getal in te vullen."
    ]
);