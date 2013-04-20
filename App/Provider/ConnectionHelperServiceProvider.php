<?php

namespace Oridoki\Koriko\App\Provider;

use Cilex\ServiceProviderInterface;
use Cilex\Application;

class ConnectionHelperServiceProvider implements ServiceProviderInterface
{

    /**
     * Set up the connection helpers
     * @param \Cilex\Application $app
     */
    public function register(Application $app)
    {
        $app['ssh'] = $app->share(function () {
            return new \Oridoki\Koriko\App\Ssh;
        });
    }
}
