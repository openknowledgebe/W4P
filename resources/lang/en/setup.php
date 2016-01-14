<?php

return [

    /*
    |--------------------------------------------------------------------------
    | W4P Setup Language File
    |--------------------------------------------------------------------------
    */

    'nav' => 'W4P Setup',

    // Steps of the progress bar
    'steps' => [
        'welcome' => "Welcome",
        'admin' => "Administration Setup",
        'platform' => "Platform Setup",
        'project' => "Project Setup",
        'finish' => "Get Started"
    ],

    // Generic setup strings (like 'Next', 'Back', and 'Oops' (reused on multiple pages)
    'generic' => [
        'back' => 'Back',
        'next' => 'Next',
        'finish' => 'Finish',
        'oops' => 'Oops!',
        'wizard' => 'Wizard',
    ],

    // Page details
    'detail' => [

        // Welcome page
        'welcome' => [
            'title' => "Welcome",
            'paragraph' => "This environment of W4P has not been set up yet. By using this wizard, you will set up the application. Click the 'Get started' button below to proceed to the next step.",
            'button' => "Get started",
        ],

        // Administration setup page
        'admin' => [
            'title' => "Administration Setup",
            'paragraph' => "Before you can set up your organisation and such, you need to set up a password. This password is used for all administrative tasks.",
            'fields' => [
                'password' => [
                    'name' => 'Password',
                    'placeholder' => 'Password',
                    'info' => "Enter a password of at least 6 characters. We recommend longer passwords."
                ],
                'passwordConfirm' => [
                    'name' => 'Confirm password',
                    'placeholder' => 'Password (again)',
                    'info' => "Repeat the same password as above."
                ]
            ],
            'validation' => [
                'nomatch' => "The passwords do not match.",
                'length' => "Your password must be 6 characters or longer.",
                'generic' => "Something went wrong saving the password in the database."
            ],
            'warnings' => [
                'alreadySet' => 'You have already set up a password for the administrator. If you enter a password, the existing password will be replaced.'
            ]
        ],

        // Platform setup page
        'platform' => [
            'title' => "Platform Setup",
            'paragraph' => "Now, we will allow you to set up the information about the platform itself.",
            'fields' => [
                'owner' => [
                    'name' => 'Platform owner',
                    'placeholder' => 'Platform owner name (e.g. Open Belgium)',
                    'info' => "Who is responsible for this crowdfunding/gathering initiative?"
                ],
                'logo' => [
                    'name' => 'Platform owner logo',
                    'existing' => 'This is the current picture. By selecting a new image in the file upload below, you will overwrite this existing logo.',
                    'info' => 'You can upload a transparent logo here. Most image formats are allowed. Recommended format: PNG with alpha channel.',
                ],
                'gaid' => [
                    'name' => 'Google Analytics ID',
                    'placeholder' => "UA-XXXXXXX-X",
                    'info' => 'If you want to use Google Analytics you can enter your API key here.'
                ],
                'mollie' => [
                    'name' => "Mollie API key",
                    'placeholder' => "XXXX_XXXXXXXXXXXXXXXXXXX",
                    'info' => "If you are going to accept payments, you will need to request a Mollie API key.",
                ]
            ]
        ],

        // Project setup page
        'project' => [
            'title' => "Project Setup",
            'paragraph' => "Next up, we will allow you to set up the project. We only need a project name and description for now.",
            'fields' => [
                'title' => [
                    'name' => 'Title of your project',
                    'placeholder' => 'e.g. Apps for Y 20XX',
                    'info' => "This is the title of your project. We recommend keeping it short and sweet."
                ],
                'brief' => [
                    'name' => 'Brief description',
                    'existing' => 'e.g. Apps for Y is looking for coaches and a budget',
                    'info' => 'Explain in less than 255 characters what your project is all about.',
                ],
            ]
        ],

        // Finish page
        'finish' => [
            'title' => 'Get started'
        ]
    ],

    'environment' => [
        'isready' => "Your environment is ready."
    ]

];
