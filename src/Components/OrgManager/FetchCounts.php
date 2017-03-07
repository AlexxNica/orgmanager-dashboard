<?php

namespace OrgManager\OrgmanagerDashboard\Components;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use OrgManager\ApiClient\OrgManager;
use OrgManager\OrgmanagerDashboard\Events\CountsFetched;

class FetchCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:orgmanager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch counts from OrgManager';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();

        $orgmanager = new OrgManager($client, config('services.orgmanager.token'));

        $counts = $orgmanager->getStats();

        event(new CountsFetched($counts));
    }
}
