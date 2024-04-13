<?php

namespace app\core;



class Session
{
    protected const MESSAGE_KEY = 'messages';   // Session key for messages

    public function __construct()
    {
        session_start();
        $messages = $_SESSION[self::MESSAGE_KEY] ?? [];
        foreach ($messages as $key => &$message) {
            $message['delete'] = true;      // marks message for deletion
        }

        $_SESSION[self::MESSAGE_KEY] = $messages;
    }

    // sets the session variable
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // gets the session variable
    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    // deletes the session variable
    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    // sets the session message
    public function setMessage($key, $message)
    {
        $_SESSION[self::MESSAGE_KEY][$key] = [
            'delete' => false,
            'value' => $message,
        ];
    }

    // get a message from the session
    public function getMessage($key)
    {
        return $_SESSION[self::MESSAGE_KEY][$key]['value'] ?? false;
    }

    // destroys the session variable
    public function __destruct()
    {
        $messages = $_SESSION[self::MESSAGE_KEY] ?? [];
        foreach ($messages as $key => &$message) {
            if ($message['delete']) {
                unset($messages[$key]);
            }
        }

        $_SESSION[self::MESSAGE_KEY] = $messages;      // stores updated messages in session
    }
}
