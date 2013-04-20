<?php

namespace Oridoki\Koriko\App\Provider;

use Cilex\ServiceProviderInterface;
use Cilex\Application;
use Oridoki\Koriko\App\CommandFinder;

class CommandServiceProvider implements ServiceProviderInterface
{
    const DEFAULT_NAMESPACE = '\\Oridoki\\Koriko\\Command\\';
    const DEFAULT_FOLDER = '/Command';

    public function register(Application $app)
    {
        if(!isset($app['command.folder'])) {
            $app['command.folder'] = function() {
                return self::DEFAULT_FOLDER;
            };
        }

        if(!isset($app['command.namespace'])) {
            $app['command.namespace'] = function() {
                return self::DEFAULT_NAMESPACE;
            };
        }

        $app['command.finder'] = $app->share(
            function () use ($app) {
                return new CommandFinder($app['command.folder'],
                        $app['command.namespace'], $app);
            }
        );

    }
}
