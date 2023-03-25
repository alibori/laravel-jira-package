<?php

declare(strict_types=1);

namespace Alibori\LaravelJiraPackage;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

final class LaravelJiraPackage
{
    private Client $client;
    private string $jira_url;
    private string $jira_username;
    private string $jira_token;
    private string $jira_board_id;
    private array $request_options;

    public function __construct()
    {
        $this->client = new Client();
        $this->jira_url = config('jira-package.jira_url');
        $this->jira_username = config('jira-package.jira_username');
        $this->jira_token = config('jira-package.jira_token');
        $this->jira_board_id = config('jira-package.jira_board_id');

        $this->request_options = [
            'auth' => [$this->jira_username, $this->jira_token],
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];
    }

    /**
     * Get the Jira Board
     *
     * @throws GuzzleException
     * @return mixed
     */
    public function getJiraBoard(): mixed
    {
        $response = $this->client->request('GET', $this->jira_url.'/rest/agile/1.0/board/'.$this->jira_board_id, $this->request_options);
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Get the Jira Board Issues
     *
     * @throws GuzzleException
     * @return mixed
     */
    public function getJiraBoardIssues(): mixed
    {
        $response = $this->client->request('GET', $this->jira_url.'/rest/agile/1.0/board/'.$this->jira_board_id.'/issue', $this->request_options);
        return json_decode($response->getBody()->getContents());
    }
}
