<?php

class PS
{
    private static$events = []; // all subscriptions

    private function __construct() { }
    private function __clone() { }

    /**
     * Subscribe a handler to a channel
     *
     * @param string   $channel
     * @param callable $handler
     * 
     */
    public static function subscribe(string $channel, callable $handler)
    {
        if (empty(self::$events[$channel]))
        {
            self::$events[$channel] = [];
        }

        array_push(self::$events[$channel], $handler);
    }

    /**
     * Calls the last subscription in the stack
     *
     * @param string $channel
     * @param string $args
     * 
     */
    public static function publish(string $channel)
    {
        if (empty(self::$events[$channel]))
        {
            return false;
        }

        $args = func_get_args();

        array_shift($args);

        if (count(self::$events[$channel]) === 1)
        {
            if (is_callable(self::$events[$channel][0]))
            {
                if (!empty($args))
                {
                    return call_user_func_array(self::$events[$channel][0], $args);
                }
                else
                {
                    return call_user_func(self::$events[$channel][0], false);
                }
            }
            else
            {
                return false;
            }
        }

        foreach (self::$events[$channel] as $event)
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
     * @param string $channel
     * 
     */
    public static function unsubscribe($channel)
    {
        if (!empty(self::$events[$channel]))
        {
            unset(self::$events[$channel]);
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
            foreach (self::$events as $channel => $handler)
            {
                unset(self::$events[$channel]);
            }
        }
    }

    /**
     * List of events
     *
     */
    public static function subscription(string $channel = '')
    {
        if ($channel && !empty(self::$events[$channel]))
        {
            return self::$events[$channel];
        }

        return self::$events;
    }
}

if (!function_exists('__')) {
    function __()
    {
        $args = func_get_args();
        $nargs = func_num_args();
        $trace = debug_backtrace();
        $caller = array_shift($trace);

        $key = $caller['file'].':'.$caller['line'];

        echo '<pre>', $key, "\n";
        for ($i=0; $i<$nargs; $i++) {
            echo print_r($args[$i], 1), "\n";
        }
        
        echo '</pre>';
    }
}
