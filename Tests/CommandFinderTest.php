<?php

namespace Oridoki\Koriko\Tests;

use Oridoki\Koriko\App\CommandFinder;
use Oridoki\Koriko\Tests\Dummy\Command\DummyCommand;

class CommandFinderTest extends \PHPUnit_Framework_TestCase
{
    use Mocks;

    protected $_subject;

    public function testScanForCustomCommandsInCustomFolder()
    {
        $folder = '/Tests/Dummy/Command';
        $namespace = '\\Oridoki\\Koriko\\Tests\\Dummy\\Command\\';
        $container = $this->dicMock(array());
        $this->_subject = new CommandFinder($folder, $namespace, $container);
        $loadedCommands = $this->_subject->getCommands();
        $command = new DummyCommand;
        $command->setContainer($container);
        $this->assertEquals(1, count($loadedCommands));
        $this->assertEquals($command, $loadedCommands[0]);
    }

}
