<?php
/**
 * Created by PhpStorm.
 * User: Thijs
 * Date: 10-12-2017
 * Time: 19:42
 */

namespace Notifier;

class Container
{

    /** @var Container */
    private static $instance = null;

    protected $clients = [];

    /**
     * Container constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Container
     */
    public static function instance(): Container
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param $callable
     * @param array $group When empty
     */
    public function add($callable, array $groups = ['all'])
    {

        if(!is_callable($callable)) {
            throw new \InvalidArgumentException('$callable is not callable');
        }

        foreach ($groups as $group) {
            $this->clients[$group][] = $callable;
        }
    }

    /**
     * @param string $group
     * @return array
     * @throws NotFound
     */
    public function get($group = 'all'): array
    {

        if (isset($this->clients[$group])) {
            return $this->clients[$group];
        }
        throw new \Exception('No notifier found');
    }

    /**
     * @return array
     */
    public function groups(): array
    {
        return array_kes($this->clients);
    }
}
