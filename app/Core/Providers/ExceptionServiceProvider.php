<?php

namespace App\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class ExceptionServiceProvider implements ServiceProviderInterface {

    protected ?string $name = null;

    public function register(DiInterface $di) : void {
        $sentryConfig = [
            'dsn'         => config('sentry.dsn'),
            'environment' => config('env'),
            'server_name' => gethostname(),
        ];

        if(!empty($release = $this->getCurrentRelease())) {
            $sentryConfig['release'] = config('app-name')." - commit: {$release}";
        }

        \Sentry\init($sentryConfig);
    }

    /**
     * @return bool|string
     */
    private function getCurrentRelease() {
        $currentBranchFilePath = app()->getRootPath('.git/HEAD');

        if(!file_exists($currentBranchFilePath)) return false;

        $currentBranchFilePath = explode(':', file_get_contents(app()->getRootPath('.git/HEAD')))[1];

        $currentCommitPath = trim(app()->getRootPath('.git/'.trim($currentBranchFilePath)));

        if(!file_exists($currentCommitPath)) return false;

        return trim(file_get_contents($currentCommitPath));
    }
}