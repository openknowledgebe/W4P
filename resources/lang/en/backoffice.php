<?php

return [
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
        ]
    ],
    "project" => "Project",
    "manageproject" => "Manage project",
    "tiers" => "Pledge tiers",
    "organisation" => "Organisation",
    "platform" => "Platform",
    "posts" => "Posts",
    "backers" => "Backers",
    "dashboard" => "Dashboard",
    "save" => "Save"
];