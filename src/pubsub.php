<?php

class PS
{
    private static $events = []; // all subscriptions

    private function __construct() { }
    private function __clone() { }

    /**
     * Subscribe a handler to a channel
     *
     * @param string   $name
     * @param callable $handler
     * 
     */
    public static function subscribe(string $name, callable $handler)
    {
        if (empty(self::$events[$name]))
        {
            self::$events[$name] = [];
        }

        array_push(self::$events[$name], $handler);
    }

    /**
     * Calls the last subscription in the stack
     *
     * @param string $name
     * @param string $args
     * 
     */
    public static function publish(string $name)
    {
        if (empty(self::$events[$name]))
        {
            return false;
        }

        $args = func_get_args();

        array_shift($args);

        if (count(self::$events[$name]) === 1)
        {
            if (is_callable(self::$events[$name][0]))
            {
                if (!empty($args))
                {
                    return call_user_func_array(self::$events[$name][0], $args);
                }
                else
                {
                    return call_user_func(self::$events[$name][0], false);
                }
            }
            else
            {
                return false;
            }
        }

        foreach (self::$events[$name] as $event)
        {
            if (is_callable($event))
            {
                call_user_func_array($event, $args);
            }
        }
    }

    /**
     * To unsubscribe from events
     *
     * @param string $name
     * 
     */
    public static function unsubscribe($name)
    {
        if (!empty(self::$events[$name]))
        {
            unset(self::$events[$name]);
        }
    }

    /**
     * Unsubscribe all subscriptions
     *
     */
    public static function flush()
    {
        if (!empty(self::$events))
        {
            foreach (self::$events as $name => $handler)
            {
                unset(self::$events[$name]);
            }
        }
    }

    /**
     * List of events
     *
     */
    public static function subscription(string $name = '')
    {
        if ($name && !empty(self::$events[$name]))
        {
            return self::$events[$name];
        }

        return self::$events;
    }
}
