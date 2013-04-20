<?php

namespace Oridoki\Koriko\Tests;

use Oridoki\Koriko\Tests\Dummy\App\DummyApplication;
use Oridoki\Koriko\Command\DemoCommand;
use Oridoki\Koriko\Tests\Dummy\Command\DummyCommand;
use Oridoki\Koriko\Tests\Mocks;

class KorikoApplicationTest extends \PHPUnit_Framework_TestCase
{
    use Mocks;

    protected $_subject;

    public function testCommandScan()
    {
        $this->_subject = $this->_buildApp();
        $command = new DemoCommand;
        $this->assertInstanceOf(
                '\Oridoki\Koriko\Command\DemoCommand',
                $this->_subject['console']->get($command->getName()));
    }

    public function testCustomFolderCommandScan()
    {
        $this->_subject = $this->_buildApp(array(
            'command.namespace' => '\\Oridoki\\Koriko\\Tests\\Dummy\\Command\\',
            'command.folder' => '/Tests/Dummy/Command'
        ));
        $command = new DummyCommand;
        $this->assertInstanceOf(
                '\Oridoki\Koriko\Tests\Dummy\Command\DummyCommand',
                $this->_subject['console']->get($command->getName()));
    }

    protected function _buildApp(array $values = array())
    {
        $subject = new DummyApplication('test', null, $values);
        $subject['logger'] = $this->loggerMock();
        $subject->loadCommands();
        return $subject;
    }
}
