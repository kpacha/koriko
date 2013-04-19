<?php

namespace Oridoki\Koriko\App\Provider;

use Cilex\ServiceProviderInterface;
use Cilex\Application;
use Cilex\Provider\ConfigServiceProvider as CilexConfigServiceProvider;

class ConfigServiceProvider extends CilexConfigServiceProvider
    implements ServiceProviderInterface
{
    const CONFIG_PATH = '/../config/config.yml';

    /**
     * Set up the default config path
     * @param \Cilex\Application $app
     */
    public function register(Application $app)
    {
        if(!isset($app['config.path'])) {
            $app['config.path'] = __DIR__ . self::CONFIG_PATH;
        }
        parent::register($app);
    }
}
