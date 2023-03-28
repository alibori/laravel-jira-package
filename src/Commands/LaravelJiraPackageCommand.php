<?php

declare(strict_types=1);

namespace Alibori\LaravelJiraPackage\Commands;

use Alibori\LaravelJiraPackage\LaravelJiraPackage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class LaravelJiraPackageCommand extends Command
{
    public $signature = 'jira:info';

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
                2 => 'See Issue Details',
            ],
            default: 0,
        );

        $this->info(string: 'You have selected: '.$choice.'! Let\'s do it!');

        match ($choice) {
            'Get the Jira Board' => $this->getJiraBoard(),
            'Get the Jira Board Issues' => $this->getJiraBoardIssues(),
            'See Issue Details' => $this->seeIssueDetails(),
            default => $this->error(string: 'Something went wrong!'),
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
                    'Highest' => $priority = '<bg=red;fg=white> '.$issue->fields->priority->name.' </>',
                    'High' => $priority = '<bg=yellow;fg=white> '.$issue->fields->priority->name.' </>',
                    'Medium' => $priority = '<bg=blue;fg=white> '.$issue->fields->priority->name.' </>',
                    'Low' => $priority = '<bg=green;fg=white> '.$issue->fields->priority->name.' </>',
                    'Lowest' => $priority = '<bg=white;fg=black> '.$issue->fields->priority->name.' </>',
                    default => $priority = '<bg=black;fg=white> '.$issue->fields->priority->name.' </>',
                };
            }

            $this->newLine();
            $this->line(string: '<options=bold>Issue: '.$issue->id.' - '.$issue->key.'</>');
            $this->newLine();
            $this->components->twoColumnDetail(first: '<fg=magenta>Issue Priority:</> ', second: $priority);
            $this->components->twoColumnDetail(first: '<fg=magenta>Issue Status:</> ', second:  $issue->fields->status?->name);
            $this->components->twoColumnDetail(first: '<fg=magenta>Issue Owner:</> ', second:  $issue->fields->assignee?->displayName);
            $this->components->twoColumnDetail(first: '<fg=magenta>Issue Due Date:</> ', second:  $issue->fields->duedate ?? 'No Due Date');
            $this->newLine();
            $this->components->twoColumnDetail(first: '');
        }
    }

    /**
     * @throws GuzzleException
     */
    protected function seeIssueDetails(): void
    {
        $package_instance = new LaravelJiraPackage();

        $issue_id = $this->ask(question: 'What is the issue ID?');

        $issue_data = $package_instance->getIssueDetails(issue_key: $issue_id);

        $this->newLine();
        $this->line(string: $issue_data->fields->description);

        $this->table(
            headers: ['Key', 'Summary', 'Status', 'Priority', 'Assignee', 'Due Date'],
            rows: [
                [
                    $issue_data->key,
                    $issue_data->fields->summary,
                    $issue_data->fields->status->name,
                    $issue_data->fields->priority?->name,
                    $issue_data->fields->assignee?->displayName,
                    $issue_data->fields->duedate ?? 'No Due Date',
                ],
            ]
        );
    }
}
