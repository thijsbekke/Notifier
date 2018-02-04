<?php
/**
 * Created by PhpStorm.
 * User: Thijs
 * Date: 10-12-2017
 * Time: 19:11
 */

namespace Notifier;

class Manager
{

    public function __construct()
    {
    }

    public function group($group, $message, $image = '')
    {

        $clients = Container::instance()->get($group);

        foreach ($clients as $client) {
            $client($message, $image);
        }
    }

    public function all($message, $image = '')
    {
        $groups = Container::instance()->groups();
        foreach ($groups as $group) {
            $this->group($group, $message, $image);
        }
    }

}
