<?php
return [

    /**
     * Emails for users
     */

    "donation_confirm" => [
        "subject" => "Bevestig uw donatie",
        "teaser" => "Uw donatie werd geregistreerd, maar is nog niet bevestigd.",
        "content" => [
            "header" => "Gelieve uw donatie te bevestigen",
            "intro" => "<p>Hello, :name.</p><p>We hebben succesvol uw donatieregistratie voor <strong>:project</strong> ontvangen.</p><p>Als een onderdeel van het systeem verwachten wij dat donors hun donaties bevestigen voordat deze erbij geteld worden.</p><p>U heeft het volgende beloofd:</p>",
            "confirm" => "Om uw donatie te bevestigen, kan u op de link hieronder klikken:",
            "confirm_action" => "Bevestig deze donatie"
        ],
    ],

    "donation_success" => [
        "subject" => "Donatie bevestigd",
        "teaser" => "Uw donatie is bevestigd.",
        "content" => [
            "header" => "Bedankt!",
            "intro" => "<p>Hello, :name.</p><p>We hebben successvol uw donatiebevestiging voor <strong>:project</strong> ontvangen.</p>",
            "confirm" => "Om uw beloofde items te raadplegen (samen met uw rewards) klikt u op de link hieronder:",
            "confirm_action" => "Bekijk mijn donatie"
        ],
    ],

    "donation_money_success" => [
        "subject" => "Betaald voor donatie!",
        "teaser" => "Uw betaling is afgerond.",
        "content" => [
            "header" => "Hartelijk bedankt voor uw donatie!",
            "intro" => "<p>Hello, :name.</p><p>We hebben uw donatie-betaling succesvol ontvangen. Dit gaat over €:amount voor <strong>:project</strong>.</p>",
            "additional_pledge" => "Hierbij heeft u ook het volgende beloofd:",
            "additional_pledge_disclaimer" => "Uw betaling werd reeds bevestigd: de maker van dit project neemt mogelijk contact met u op over de bovenstaande items.",
            "confirm" => "Om uw beloofde items te raadplegen (samen met uw rewards) klikt u op de link hieronder:",
            "confirm_action" => "Bekijk mijn donatie"
        ],
    ],
];
