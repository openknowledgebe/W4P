<?php

return [

    /**
     * GENERIC WORDS
     */

    "project" => "Project",
    "manageproject" => "Manage project",
    "tiers" => "Reward tiers",
    "organisation" => "Organisation",
    "platform" => "Platform",
    "posts" => "Posts",
    "backers" => "Backers",
    "dashboard" => "Dashboard",
    "save" => "Save",
    "create" => "Create",
    "edit" => "Edit",
    "delete" => "Delete",
    "create_tier" => "Create a new tier",

    /**
     * WARNINGS
     */

    "warnings" => [
        "no_tiers" => "You have not created any tiers yet.",
        "no_posts" => "You have not created any posts yet."
    ],

    /**
     * FLASH MESSAGES
     */

    "flash" => [
        "project_update_success" => "Your project's details were updated successfully.",
        "org_update_success" => "Your organisation's details were updated successfully.",
        "platform_update_success" => "Your platform's details were updated successfully.",
        "post_create_success" => "A post was successfully created.",
        "post_update_success" => "A post was successfully updated.",
        "tier_create_success" => "A tier was successfully created.",
        "tier_update_success" => "A post was successfully updated.",
    ],

    /**
     * PAGE TITLES & DESCRIPTIONS
     * (for pages that already have labels defined in setup translation file)
     */

    "page" => [
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
                    "info" => "You can enter a video URL here."
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
        ]
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
    ]
];