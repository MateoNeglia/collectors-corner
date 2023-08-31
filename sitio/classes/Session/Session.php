<?php

namespace Collector\Session;

class Session
{    
    public function flash(string $name, $default = null) {
        $value = $_SESSION[$name] ?? $default;
        unset($_SESSION[$name]);
        return $value;
    }
}
