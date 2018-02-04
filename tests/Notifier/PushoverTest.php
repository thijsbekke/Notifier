<?php
/**
 * Created by PhpStorm.
 * User: Thijs
 * Date: 28-1-2018
 * Time: 16:01
 */

namespace Notifier;

class PushoverTest extends \TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testMessage()
    {

        $message = "Whoop whoop";
        //Notificeer de group
        $thijs = new \Notifier\Clients\Pushover('');
        $thijs->message($message);
        $thijs->image('assets/rabbit.jpeg');
        $thijs->sound('incoming');
        $thijs->send();

        $this->assertTrue(true);
    }
}
