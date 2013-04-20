<?php

namespace Oridoki\Koriko\App;

use Cilex\Application as CilexApplication;
use Oridoki\Koriko\App\Provider\LogServiceProvider;
use Oridoki\Koriko\App\Provider\ConfigServiceProvider;
use Oridoki\Koriko\App\Provider\CommandServiceProvider;
use Oridoki\Koriko\App\Provider\ConnectionHelperServiceProvider;

class KorikoApplication extends CilexApplication
{

    /**
     * Registers the autoloader and necessary components.
     *
     * @param string      $name    Name for this application.
     * @param string|null $version Version number for this application.
     */
    public function __construct($name, $version = null, array $values = array())
    {
        parent::__construct($name, $version, $values);
        
        $this->_registerDefaultProviders($values);
    }

    protected function _registerDefaultProviders($values)
    {
        $this->_registerConfigServiceProvider($values);
        $this->_registerLogServiceProvider($values);
        $this->_registerDefaultCommandServiceProvider($values);
        $this->_registerConnectionHelperServiceProvider($values);
    }

    protected function _registerConfigServiceProvider($values)
    {
        $this->register(new ConfigServiceProvider, $values);
    }

    protected function _registerLogServiceProvider($values)
    {
        $this->register(new LogServiceProvider, $values);
    }

    protected function _registerDefaultCommandServiceProvider($values)
    {
        $this->register(new CommandServiceProvider, $values);
    }

    protected function _registerConnectionHelperServiceProvider($values)
    {
        $this->register(new ConnectionHelperServiceProvider, $values);
    }

    /**
     * Load all commands returned by the injected service provider
     */
    protected function _loadCommands()
    {
        $this['logger']->addDebug('loading commands');
        $commands = $this['command.finder']->getCommands();
        foreach ($commands as $command) {
            $this->command($command);
        }
    }

    /**
     * Loads the commands and executes this application.
     *
     * @param bool $interactive runs in an interactive shell if true.
     */
    public function run($interactive = false)
    {
        $this->_loadCommands();
        parent::run($interactive);
    }

}
