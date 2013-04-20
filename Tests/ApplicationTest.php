<?php

namespace Oridoki\Koriko\Tests;

use Oridoki\Koriko\Tests\Dummy\App\DummyApplication;
use Oridoki\Koriko\Command\DemoCommand;
use Oridoki\Koriko\Tests\Dummy\Command\DummyCommand;
use Oridoki\Koriko\Tests\Mocks;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    use Mocks;

    protected $_subject;

    public function setUp()
    {
        $this->_subject = $this->_buildApp();
    }

    public function testCommandScan()
    {
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

    public function testLoggerGeneration()
    {
        $this->_assertDependency('logger', '\Monolog\Logger');
    }

    public function testSshHelperGeneration()
    {
        $this->_assertDependency('ssh', '\Oridoki\Koriko\App\Ssh');
    }

    public function testConfigPathGeneration()
    {
        $this->assertNotNull($this->_subject['config.path']);
    }

    public function testConfigGeneration()
    {
        $this->assertNotNull($this->_subject['config']);
    }

    protected function _assertDependency($helperName, $helperClass)
    {
        $dependency = $this->_subject[$helperName];
        $this->assertNotNull($dependency);
        $this->assertInstanceOf($helperClass, $dependency);
    }

    protected function _buildApp(array $values = array())
    {
        $subject = new DummyApplication('test', null, $values);
        $subject['logger'] = $this->loggerMock();
        $subject->loadCommands();
        return $subject;
    }
}
