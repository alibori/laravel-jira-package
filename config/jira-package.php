<?php

declare(strict_types=1);

// config for Alibori/LaravelJiraPackage
return [
    /**
     * This is the configuration file for the Laravel Jira Package
     */
    'jira_url' => env('JIRA_URL', 'https://jira.example.com'),
    'jira_username' => env('JIRA_USERNAME', 'jira_username'),
    'jira_token' => env('JIRA_TOKEN', 'jira_token'),

    'jira_board_id' => env('JIRA_BOARD_ID', 1),
];
