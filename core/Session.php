<?php

namespace app\core;



class Session
{
    protected const MESSAGE_KEY = 'messages';

    public function __construct()
    {
        session_start();
        $messages = $_SESSION[self::MESSAGE_KEY] ?? [];
        foreach ($messages as $key => &$message) {
            $message['delete'] = true;
        }

        $_SESSION[self::MESSAGE_KEY] = $messages;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function setMessage($key, $message)
    {
        $_SESSION[self::MESSAGE_KEY][$key] = [
            'delete' => false,
            'value' => $message,
        ];
    }

    public function getMessage($key)
    {
        return $_SESSION[self::MESSAGE_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        $messages = $_SESSION[self::MESSAGE_KEY] ?? [];
        foreach ($messages as $key => &$message) {
            if ($message['delete']) {
                unset($messages[$key]);
            }
        }

        $_SESSION[self::MESSAGE_KEY] = $messages;
    }
}
