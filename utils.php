<?php

class Session
{
    public static function start()
    {
        session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function retrive($key, $default = null)
    {
        if (!isset($_SESSION[$key])) return $default;

        $value = $_SESSION[$key];
        unset($_SESSION[$key]);

        return $value;
    }

    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
}


class Redirect
{
    public static function to($url)
    {
        header("Location: ". Router::baseUrl($url));
        exit();
    }

    public static function back()
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? Router::baseUrl();
        self::to($referer);
    }

    public static function withMessage($name, $message)
    {
        Session::set($name, $message);
        return new self();
    }
}
