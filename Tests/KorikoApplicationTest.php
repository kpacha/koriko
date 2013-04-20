<?php

namespace Oridoki\Koriko\Tests;

use Oridoki\Koriko\Tests\Dummy\App\DummyApplication;
use Oridoki\Koriko\Command\DemoCommand;

class KorikoApplicationTest extends \PHPUnit_Framework_TestCase
{
    protected $_subject;

    public function setUp()
    {
        $this->_subject = new DummyApplication('test');
    }

    public function testCommandScan()
    {
        $this->_subject->loadCommands();
        $command = new DemoCommand;
        $command->setContainer($this->_subject);
        $this->_subject['console']->get($command->getName());
    }
}
