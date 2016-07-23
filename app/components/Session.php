<?php

namespace Rippler\Components;

class Session
{
    public function get($key, $default = null)
    {
        if (isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }

        return $default;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function userId()
    {
        return $this->get('user_id', 1);
    }

    public function id()
    {
        return session_id();
    }
}
