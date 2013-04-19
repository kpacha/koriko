<?php

namespace Oridoki\Koriko\App;

use Symfony\Component\Finder\Finder;
use \Pimple;

class CommandFinder
{

    /**
     * Commands folder
     * @var string
     */
    protected $_folder;

    /**
     * Commands namespace
     * @var string
     */
    protected $_namespace;

    /**
     * Commands namespace
     * @var \Pimple
     */
    protected $_container;

    /**
     * Set up the instance
     * @param string $folder
     * @param string $namespace
     * @param \Pimple $container
     */
    public function __construct($folder, $namespace, Pimple $container)
    {
        $this->_folder = $folder;
        $this->_namespace = $namespace;
        $this->_container = $container;
    }

    /**
     * Get an array of all the avilable commands
     * @return array
     */
    public function getCommands()
    {
        $commands = array();
        foreach ($this->_allCommands() as $file) {
            $commands[] = $this->_command($file);
        }
        return $commands;
    }

    /**
     * Get a list of all commands
     * @return \Symfony\Component\Finder\Finder
     */
    protected function _allCommands()
    {
        $finder = new Finder;
        $finder->files()->name('*Command.php')->in($this->_folder());

        return $finder;
    }

    /**
     * Get the command for a given file
     * @param string $file
     * @return Symfony\Component\Console\Command\Command
     */
    protected function _command($file)
    {
        $command = $this->_namespace . $this->_commandName($file);
        $commandInstance = new $command;
        $commandInstance->setContainer($this->_container);
        return $commandInstance;
    }

    /**
     * Get the command name for a given file
     * @param string $file
     * @return string
     */
    protected function _commandName($file)
    {
        return str_replace('.php', '', $file->getRelativePathname());
    }

    /**
     * Get the commands folder
     * @return string
     */
    protected function _folder()
    {
        return dirname(__DIR__) . $this->_folder;
    }
}
