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

    public function start($user_id)
    {
        session_regenerate_id(true);
        session_write_close();
        session_start();

        $this->set('user_id', $user_id);
    }

    public function userId()
    {
        return $this->get('user_id');
    }

    public function id()
    {
        return session_id();
    }
}
