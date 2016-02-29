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
        'admin' => "Administration",
        'platform' => "Platform",
        'organisation' => "Organisation",
        'project' => "Project",
        'mail' => "Email",
        'finish' => "Finalize"
    ],

    // Generic setup strings (like 'Next', 'Back', and 'Oops' (reused on multiple pages)
    'generic' => [
        'back' => 'Back',
        'next' => 'Next',
        'finish' => 'Finish',
        'oops' => 'Oops!',
        'wizard' => 'Wizard',
        'mailFail' => 'There was an issue sending your mail message. Please check the configuration and try again.',
        'mailSuccess' => 'If you have received this message, you have successfully set up the mail configuration for a W4P installation configured with this mail account.'
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

        // Organisation setup page

        'organisation' => [
            'title' => "Organisation Setup",
            'paragraph' => "Next, set up information about your organisation.",
            'fields' => [
                'name' => [
                    'name' => "Name of your organisation",
                    'placeholder' => "My Organisation",
                    'info' => "Enter your organisation's name here."
                ],
                'logo' => [
                    'name' => "Organisation logo",
                    'existing' => "You have already set an organisation logo. You can set it again.",
                    'info' => "Upload your organisation's logo here. You must upload an image."
                ],
                'description' => [
                    'name' => "Description",
                    'placeholder' => "Enter a short description here",
                    'info' => "Enter your organisation's description here. Keep it brief, though."
                ],
                'website' => [
                    'name' => "Website of your organisation",
                    'placeholder' => "http://website.com",
                    'info' => "Enter your organisation's website URL here."
                ],
            ]
        ],

        // Project setup page
        'project' => [
            'title' => "Project Setup",
            'paragraph' => "Next up, we will allow you to set up the project. We only need a project name and description for now. (We will default the start date of your campaign to today, and the end date for next month. You can adjust more details later.)",
            'fields' => [
                'title' => [
                    'name' => 'Title of your project',
                    'placeholder' => 'e.g. Apps for Y 20XX',
                    'info' => "This is the title of your project. We recommend keeping it short and sweet."
                ],
                'brief' => [
                    'name' => 'Brief description',
                    'placeholder' => 'e.g. Apps for Y is looking for coaches and a budget',
                    'info' => 'Explain in less than 255 characters what your project is all about.',
                ],
                'startdate' => [
                    'name' => 'Start date (pledges open)',
                    'placeholder' => 'e.g. 2016-11-30 12:00:00',
                    'info' => 'The start date of your project. From this point on, pledges can be made. Remember, your project will not be hidden if you set the start date in the future.',
                ],
                'enddate' => [
                    'name' => 'End date (pledges close)',
                    'placeholder' => 'e.g. 2016-12-30 12:00:00',
                    'info' => 'The end date of your project. After this date your project is closed (still visible but pledges cannot be added).',
                ],
            ]
        ],

        // Email setup page

        'mail' => [
            'title' => "Email Setup",
            'paragraph' => "You need a SMTP-capable mail server. It will be used to send backers updates as well as confirmation messages for pledges. Please note that we will be sending a test mail to ensure that this configuration is correct.",
            'fields' => [
                'host' => [
                    'name' => 'SMTP Host',
                    'placeholder' => 'e.g. smtp.mydomain.com',
                    'info' => "The hostname of your mail server. This can also be an IP address. If you are setting this up locally, you can use 127.0.0.1, for example."
                ],
                'port' => [
                    'name' => 'Port',
                    'placeholder' => 'e.g. 1025',
                    'info' => 'The port for the SMTP server.',
                ],
                'username' => [
                    'name' => 'SMTP Username',
                    'placeholder' => 'e.g. mail@mydomain.com',
                    'info' => 'This username is used to authenticate with the mail server. In many cases you use the email address here.',
                ],
                'password' => [
                    'name' => 'SMTP Password',
                    'placeholder' => 'Enter your password here',
                    'info' => 'In order to authenticate with the server, we will also need a password. Please note that the password is stored in plain-text in the database.',
                ],
                'from' => [
                    'name' => 'Sender email address (from)',
                    'placeholder' => 'e.g. mail@mydomain.com',
                    'info' => 'The email address that will appear in the "from" field in email clients.',
                ],
                'name' => [
                    'name' => 'Sender name',
                    'placeholder' => 'e.g. John Appleseed',
                    'info' => 'The name that will appear in the "from" field in email clients.',
                ],
                'encryption' => [
                    'name' => 'SMTP Encryption',
                    'info' => 'Select the type of encryption that is used when authenticating with the SMTP server. In most cases, this is going to be TLS.',
                ],
            ]
        ],

        // Finish page
        'finish' => [
            'title' => 'Finalize Setup',
            'paragraph' => "If you are happy with the current settings, please confirm that you would like to finalize the setup process. Once the setup is finalized, you will be taken to the website.
            Use the administration link at the bottom of the page to log in and manage your project's information and more."
        ]
    ],

    'preq' => [
        "prerequisite_page_title" => "Prerequisites",
        "prerequisite_page_description" => "Below you can find a list of successful and failed prerequisites.",
        "prerequisite" => "Prerequisite",
        "status" => "Status",
        "titles" => [
            "npm_modules" => "npm modules",
            "database_connection" => "Database connection",
            "laravel_installation" => "Laravel installation",
            "writable" => "Writeable folders"
        ],
        "errors" => [
            "npm_modules" => "The node_modules folder seems to be missing.",
            "database_connection" => "There seems to be an issue with the database connection.",
            "writable" => "One or more of the prerequisite folders that must be writable are not writable."
        ],
        "checkmark" => "✓",
    ],

    'environment' => [
        'isready' => "Your environment is ready."
    ]

];
