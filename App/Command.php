<?php

namespace Oridoki\Koriko\App;

use Symfony\Component\Console\Command\Command as ConsoleCommand;
use \Pimple;

class Command extends ConsoleCommand
{
    /**
     * The dependency injection container
     * @var \Pimple
     */
    protected $_container;

    /**
     * DIC setter
     * @param \Pimple $container
     */
    public function setContainer(Pimple $container)
    {
        $this->_container = $container;
    }
}
