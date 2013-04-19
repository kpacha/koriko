<?php

namespace Oridoki\Koriko\App\Provider;

use Cilex\ServiceProviderInterface;
use Cilex\Application;
use Oridoki\Koriko\App\CommandFinder;

class CommandServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['command.finder'] = $app->share(
            function () use ($app) {
                $namespace = '\\Oridoki\\Koriko\\Command\\';
                if(isset($app['command.namespace'])) {
                    $namespace = $app['command.namespace'];
                }
                $folder = '/Command';
                if(isset($app['command.folder'])) {
                    $folder = $app['command.folder'];
                }
                    
                return new CommandFinder($folder, $namespace, $app);
            }
        );

    }
}
