<?php

return [

    /**
     * GENERIC WORDS
     */

    "project" => "Project",
    "manageproject" => "Manage project",
    "manage_pages" => "Manage pages",
    "tiers" => "Reward tiers",
    "organisation" => "Organisation",
    "platform" => "Platform",
    "posts" => "Posts",
    "goals" => "Goals",
    "backers" => "Backers",
    "donations" => "Donations",
    "dashboard" => "Dashboard",
    "social" => "Social",
    "socialmedia" => "Social media",
    "social_settings" => "Social media settings",
    "pw_reset" => "Password change",
    "subcategories" => 'subcategory|subcategories',
    "goal_overview" => "Goal overview",
    "email" => "Email",
    "save" => "Save",
    "create" => "Create",
    "edit" => "Edit",
    "delete" => "Delete",
    "create_tier" => "Create a new tier",
    "assets" => "Uploaded images",
    "download" => "Download",
    "download_donors" => "Unique donors (CSV)",
    "download_tiers" => "Tiers and donors (CSV)",
    "manage" => "Manage",
    "view" => "View",
    "change_password" => "Change admin password",
    "administration" => "Administration",
    "previous_projects" => "Previous projects",
    "import_previous_project" => "Import previous project",
    "do_import" => "Import",
    "general_platform" => "General configuration",
    "manage_weights" => "Manage category weights",

    /**
     * KINDS OF TYPES
     */

    "manpower" => "People",
    "material" => "Materials",
    "coaching" => "Coaching",
    "currency" => "Money",

    /**
     * WARNINGS
     */

    "warnings" => [
        "no_tiers" => "You have not created any tiers yet.",
        "no_posts" => "You have not created any posts yet.",
        "no_archived" => "You have not imported any previous projects yet."
    ],

    /**
     * FLASH MESSAGES
     */

    "flash" => [
        "project_update_success" => "Your project's details were updated successfully.",
        "org_update_success" => "Your organisation's details were updated successfully.",
        "platform_update_success" => "Your platform's details were updated successfully.",
        "page_update_success" => "A page was successfully saved.",
        "post_create_success" => "A post was successfully created.",
        "post_update_success" => "A post was successfully updated.",
        "tier_create_success" => "A tier was successfully created.",
        "tier_update_success" => "A post was successfully updated.",
        "mail_validation_failed" => "There was a problem sending a test message using this new configuration. Please check the configuration and try again.",
        "mail_validation_success" => "Your new email configuration works!",
        "goal_save_success" => "Your new goal has been successfully saved!",
        "goal_update_success" => "Your goal has been successfully updated!",
        "currency_update_success" => "Your money goal has been successfully updated!",
        "password_change_success" => "Your password has been successfully updated! From now on, you must use this new password to sign in.",
    ],

    /**
     * PAGE TITLES & DESCRIPTIONS
     * (for pages that already have labels defined in setup translation file)
     */

    "page" => [
        "previous_projects" => [
            "about" => "You can import previous projects here by providing their URL. These projects then show up on the 'Previous Projects' page.",
        ],
        "pw_reset" => [
            "about" => "You can change your existing password here."
        ],
        "project" => [
            "about" => "You can edit your campaign here.",
            "fields" => [
                "description" => [
                    "name" => "Description",
                    "placeholder" => "Long description here. Markdown is supported.",
                    "info" => "You can type a longer description here. This is what people see when they arrive on the project page. You can use Markdown!"
                ],
                "logo" => [
                    "name" => "Project logo",
                    "existing" => "You have already uploaded a logo. If you want to upload a new logo, you can select it below.",
                    "info" => "You can upload a project logo here."
                ],
                "video" => [
                    "name" => "Project video provider",
                    "info" => "Select a video provider from the list."
                ],
                "video-url" => [
                    "name" => "Video URL",
                    "placeholder" => "YouTube/Vimeo URL",
                    "info" => "You can enter a video URL here. YouTube and Vimeo URLs are currently supported."
                ],
                "banner" => [
                    "name" => "Project banner",
                    "existing" => "You have already uploaded a banner. If you want to upload a new banner, you can select it below.",
                    "info" => "You can upload a project banner here. Recommended size: 200x1000px."
                ]
            ]
        ],
        "organisation" => [
            "about" => "You can edit information about your organisation here.",
            // Please note that the field text used here is sourced from setup.php's translation file
        ],
        "platform" => [
            "about" => "You can edit your platform's configuration here."
        ],
        "tiers" => [
            "about" => "You can manage your project's pledge tiers here."
        ],
        "posts" => [
            "about" => "You can manage your project's posts here. Posts act as updates and people who have contributed will be messaged automatically if they chose to receive mails about this project."
        ],
        "email" => [
            "about" => "You can adjust your mailer configuration here. Please note that we will be sending a test mail to ensure that this configuration is correct."
        ],
        "goals" => [
            "about" => "You can manage your goals here.",
            "desc" => "Description:",
            "unit_desc" => "Unit description:",
            "required_amount" => "Required units:"
        ],
        "goal_kind" => [
            "about" => "You can manage all types of contributions that donors can do in this category. You can create new subcategories for this kind of contribution. (e.g. for people you can add 'cook')."
        ],
    ],

    /**
     * EDIT/NEW TIER
     */

    "edit_tier" => [
        "title" => "Edit a reward tier",
        "about" => "You can edit an existing tier here."
    ],
    "new_tier" => [
        "title" => "Create a reward tier",
        "about" => "You can create a new tier here."
    ],
    "tier_form" => [
        "value" => [
            "name" => "Minimum required contribution",
            "placeholder" => "5",
            "info" => "The minimum required contribution that must be paid before this tier is reached. Each tier requires a separate value.",
        ],
        "description" => [
            "name" => "Description",
            "placeholder" => "You can write a description here.",
            "info" => "You can write about the rewards here. You cannot use Markdown here.",
        ]
    ],

    /**
     * GOALS
     */

    "currency_goal" => [
        "title" => "Set money goal",
        "about" => "You can set the desired amount of money you'd like to collect during the lifetime of the project."
    ],

    "new_goalType" => [
        "title" => "Create a new goal",
        "about" => "You can create a new goal here."
    ],
    "edit_goalType" => [
        "title" => "Edit an existing goal",
        "about" => "You can edit an existing goal here."
    ],
    "goalType_form" => [
        "name" => [
            "name" => "Goal name",
            "placeholder" => "e.g. Freelance cook",
            "info" => "The name that appears in the list of possible contributions. If you're looking for a cook, you can type 'Cook' here.",
        ],
        "description" => [
            "name" => "Goal description",
            "placeholder" => "e.g. We're looking for a freelance cook capable of doing...",
            "info" => "This description should contain more information about the goal.",
        ],
        "unit_description" => [
            "name" => "Unit description",
            "placeholder" => "e.g. A single day of cooking (7,6 hours)",
            "info" => "Explain what a single unit consists of. For example, you might need a cook for 3 days. A unit can be 1 day of cooking, for instance, and you set the units required field to 3.",
        ],
        "required_amount" => [
            "name" => "Units required",
            "placeholder" => "e.g. 15",
            "info" => "How many units as described above are required.",
        ],
    ],
    "currency_form" => [
        "value" => [
            "name" => "Desired amount (€)",
            "placeholder" => "e.g. 9000",
            "info" => "Leave this at 0.0 if you do not want a money goal. If you want a monetary goal, enter a valid decimal number here."
        ]
    ],

    /**
     * EDIT/NEW POST
     */

    "create_post" => "Create a new post",
    "new_post" => [
        "title" => "Create a new post",
        "about" => "You can create a new post here.",
    ],
    "edit_post" => [
        "title" => "Edit a  post",
        "about" => "You can edit an existing post here. Please note that people who have donated will not be notified about these changes.",
    ],
    "post_form" => [
        "title" => [
            "name" => "Title",
            "placeholder" => "e.g. Update #1: This is an update!",
            "info" => "The title of your post should be short but sweet.",
        ],
        "content" => [
            "name" => "Content",
            "placeholder" => "You can write the content of your post here.",
            "info" => "You can use Markdown here and drag and drop images here if you want to include them in your post.",
        ]
    ],

    "edit_page" => [
        "title" => "Edit a page",

        "about" => "You can edit your page below."
    ],
    "page_form" => [
        "title" => [
            "name" => "Title",
            "placeholder" => "e.g. My page title",
            "info" => "The title of your title should be short but sweet.",
            "why_fixed" => "This is a special pre-defined page. You cannot edit this title. ",
        ],
        "content" => [
            "name" => "Content",
            "placeholder" => "You can write the content of your page here.",
            "info" => "You can use Markdown here and drag and drop images here if you want to include them in your post.",
        ]
    ],

    /**
     * IMPORT
     */

    "import" => [
        "title" => "Import a project",
        "about" => "You can import a previous project by entering an URL below.",
    ],
    "import_form" => [
        "url" => [
            "name" => "URL (of a W4P project)",
            "placeholder" => "http://your-url-here.url",
            "info" => "You must enter the main URL here. Please be patient after pressing the 'Import' button, W4P needs to get a bunch of information from this other W4P installation."
        ]
    ],

    /**
     * DASHBOARD
     */

    "dashboard_page" => [
        "latest_donations" => "Latest 5 donations",
        "show_all_donations" => "Show all donations",
        "total_contributed" => "Total € contributed",
        "with_goal_of" => "with a goal of",
        "goal_progress" => "Goal progress",
        "name" => "Name",
        "units_donated" => "Units",
        "amount_donated" => "Amount",
        "confirmed" => "Confirmed",
        "has_message" => "Message",
        "total_donors" => "Total donors",
        "unique_donors" => "unique donors",
        "order_page" => "Secret page"
    ],

];