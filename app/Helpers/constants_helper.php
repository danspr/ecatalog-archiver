<?php

use CodeIgniter\CodeIgniter;


/**
 * Retrieves the name of the application.
 *
 * @return string
 */
function getAppName(): string
{
    return 'eCatalog Archiver';
}

/**
 * Get the string value associated with the given key.
 *
 * @param mixed $key The key to look up in the array
 * @return string The string value associated with the key, or an empty string if the key is not found
 */
function getString($key): string 
{
    $arrayString = [
        'error.generic' => 'An error occurred. Please try again later.',
        'error.username_already_exist' => 'This username is already registered. Please use a different username.',
        'error.session_expired' => 'Session expired. Please log in again.',
        'error.login_failed' => 'Incorrect username or password. Please try again.',
        'error.old_password_not_match' => 'The old password does not match. Please try again.',

        'success.login' => 'Login successful. Welcome back!',
        'success.logout' => 'Logout successful.',
        'success.update' => 'Data successful updated!',
        'success.insert' => 'Data successful inserted!',
        'success.delete' => 'Data successful deleted!',
    ];

    if (isset($key) && array_key_exists($key, $arrayString)) {
        $value = $arrayString[$key];
    } else {
        $value = '';
    }
    return $value;
}
