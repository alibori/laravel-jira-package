<?php

declare(strict_types=1);

namespace Alibori\LaravelJiraPackage\Commands;

use Alibori\LaravelJiraPackage\LaravelJiraPackage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class LaravelJiraPackageCommand extends Command
{
    public $signature = 'jira-pkg:jira';

    public $description = 'Command to interact with Jira API';

    /**
     * @throws GuzzleException
     */
    public function handle(): int
    {
        $choice = $this->choice(
            question: 'What do you want to do with Jira?',
            choices: [
                0 => 'Get the Jira Board',
                1 => 'Get the Jira Board Issues',
            ],
            default: 0,
        );

        $this->info(string: 'You have selected: '.$choice.'! Let\'s do it!');

        match ($choice) {
            'Get the Jira Board' => $this->getJiraBoard(),
            'Get the Jira Board Issues' => $this->getJiraBoardIssues(),
        };

        return self::SUCCESS;
    }

    /**
     * @throws GuzzleException
     */
    protected function getJiraBoard(): void
    {
        $package_instance = new LaravelJiraPackage();

        $board_data = $package_instance->getJiraBoard();

        $this->line(string: 'Board Name: '.$board_data->name);
    }

    /**
     * @throws GuzzleException
     */
    protected function getJiraBoardIssues(): void
    {
        $package_instance = new LaravelJiraPackage();

        $board_issues_data = $package_instance->getJiraBoardIssues();

        foreach ($board_issues_data->issues as $issue) {
            $priority = '';
            if ($issue->fields->priority) {
                match ($issue->fields->priority->name) {
                    'Highest' => $priority = '<bg=red;fg=white>'.$issue->fields->priority->name.'</>',
                    'High' => $priority = '<bg=yellow;fg=white>'.$issue->fields->priority->name.'</>',
                    'Medium' => $priority = '<bg=blue;fg=white>'.$issue->fields->priority->name.'</>',
                    'Low' => $priority = '<bg=green;fg=white>'.$issue->fields->priority->name.'</>',
                    'Lowest' => $priority = '<bg=white;fg=black>'.$issue->fields->priority->name.'</>',
                    default => $priority = '<bg=black;fg=white>'.$issue->fields->priority->name.'</>',
                };
            }

            $this->line(string: '');
            $this->line(string: '<fg=magenta>Issue ID / Key:</> '.$issue->id.' / '.$issue->key);
            $this->line(string: '<fg=magenta>Issue Priority:</> '.$priority);
            $this->line(string: '<fg=magenta>Issue Status:</> '.$issue->fields->status?->name);
            $this->line(string: '<fg=magenta>Issue Owner:</> '.$issue->fields->assignee?->displayName);
            $this->line(string: '<fg=magenta>Issue Due Date:</> '.$issue->fields->duedate ?? 'No Due Date');
            $this->line(string: '');
            $this->line(string: '<fg=magenta>**********************</>');
        }
    }
}
