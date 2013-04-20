<?php

namespace Oridoki\Koriko\Tests;

use Oridoki\Koriko\Tests\Dummy\App\DummyApplication;
use Oridoki\Koriko\Command\DemoCommand;
use Oridoki\Koriko\Tests\Dummy\Command\DummyCommand;

class KorikoApplicationTest extends \PHPUnit_Framework_TestCase
{
    protected $_subject;

    public function testCommandScan()
    {
        $this->_subject = new DummyApplication('test');
        $this->_subject->loadCommands();
        $command = new DemoCommand;
        $this->assertInstanceOf(
                '\Oridoki\Koriko\Command\DemoCommand',
                $this->_subject['console']->get($command->getName()));
    }

    public function testCustomFolderCommandScan()
    {
        $this->_subject = new DummyApplication('test', null, array(
            'command.namespace' => '\\Oridoki\\Koriko\\Tests\\Dummy\\Command\\',
            'command.folder' => '/Tests/Dummy/Command'
        ));
        $this->_subject->loadCommands();
        $command = new DummyCommand;
        $this->assertInstanceOf(
                '\Oridoki\Koriko\Tests\Dummy\Command\DummyCommand',
                $this->_subject['console']->get($command->getName()));
    }
}
