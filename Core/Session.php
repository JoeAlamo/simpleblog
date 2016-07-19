<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 17:03
 */

namespace Core;


class Session
{
    /**
     * Initialise the session
     * @throws \Exception
     */
    public static function start()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // If we can't start the session something is very wrong
            if (!session_start()) {
                throw new \Exception('Unable to start session');
            }
        }
    }

    /**
     * Set the necessary session variables to indicate the user is logged in
     * @todo Move this to a separate auth class
     */
    public static function login()
    {
        // Destroy current session to prevent session fixation attacks
        static::logout();

        // Start new session and regenerate ID to prevent session attacks
        static::start();
        session_regenerate_id(true);

        $_SESSION['admin'] = true;
    }

    /**
     * Destroy the current session
     * @todo Move aspects to separate auth class
     * @param bool $removeCookie
     */
    public static function logout($removeCookie = false) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // If we can't start the session we can't destroy it
            if (!session_start()) {
                return;
            }
        }

        // Source: http://php.net/manual/en/function.session-destroy.php
        // Unset session vars
        $_SESSION = array();
        // Remove cookie
        if ($removeCookie) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();
    }

    /**
     * @return bool
     */
    public static function isLoggedIn()
    {
        return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
    }
}