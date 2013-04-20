<?php

namespace Oridoki\Koriko\App\Provider;

use Cilex\ServiceProviderInterface;
use Cilex\Application;
use Cilex\Provider\MonologServiceProvider;

class LogServiceProvider extends MonologServiceProvider
    implements ServiceProviderInterface
{
    const LOG_PATH = '/../logs/koriko.log';
    const LOG_NAME = 'koriko';

    /**
     * Set up the default config path
     * @param \Cilex\Application $app
     */
    public function register(Application $app)
    {
        if(!isset($app['monolog.name'])) {
            $app['monolog.name'] = function() {
                return self::LOG_NAME;
            };
        }

        if(!isset($app['monolog.logfile'])) {
            $app['monolog.logfile'] = function() {
                return __DIR__ . self::LOG_PATH;
            };
        }

        parent::register($app);
    }
}
