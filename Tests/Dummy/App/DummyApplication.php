<?php
namespace Oridoki\Koriko\Tests\Dummy\App;

use Oridoki\Koriko\App\KorikoApplication;

/**
 * Dummy extension of the koriko Application for testing purpouses
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class DummyApplication extends KorikoApplication
{

    /**
     * Expose the _loadCommands() method for testing
     */
    public function loadCommands()
    {
        $this->_loadCommands();
    }
}