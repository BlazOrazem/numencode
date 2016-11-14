<?php

namespace Numencode\Utils;

class Flash
{
    /**
     * Create a flash message.
     *
     * @param string      $title   Flash message title
     * @param string      $message Flash message content
     * @param string      $level   Flash message level (success, warning, info, danger)
     * @param int         $timeout Timeout before flash message is closed in milliseconds
     * @param null|string $button  Text on the button for overlay flash message
     * @param null|string $key     Flash message key
     *
     * @return void
     */
    public function create($title, $message, $level, $timeout = 3000, $button = null, $key = null)
    {
        session()->flash(
            $key ?: 'flash_message',
            [
                'title'   => $title,
                'message' => $message,
                'level'   => $level,
                'button'  => $button,
                'timeout' => $timeout,
            ]
        );
    }

    /**
     * Create an information flash message.
     *
     * @param string $title   Flash message title
     * @param string $message Flash message content
     *
     * @return void
     */
    public function info($title, $message)
    {
        $this->create($title, $message, 'info');
    }

    /**
     * Create a success flash message.
     *
     * @param string   $title   Flash message title
     * @param string   $message Flash message content
     * @param int|null $timeout Timeout before flash message is closed in milliseconds
     *
     * @return void
     */
    public function success($title, $message, $timeout = null)
    {
        $this->create($title, $message, 'success', $timeout);
    }

    /**
     * Create a warning flash message.
     *
     * @param string $title   Flash message title
     * @param string $message Flash message content
     *
     * @return void
     */
    public function warning($title, $message)
    {
        $this->create($title, $message, 'warning');
    }

    /**
     * Create an error flash message.
     *
     * @param string $title   Flash message title
     * @param string $message Flash message content
     *
     * @return void
     */
    public function error($title, $message)
    {
        $this->create($title, $message, 'error');
    }

    /**
     * Create an overlay flash message.
     *
     * @param string $title   Flash message title
     * @param string $message Flash message content
     * @param string $level   Flash message level (success, warning, info, danger)
     * @param string $button  Text on the button for overlay flash message
     *
     * @return void
     */
    public function overlay($title, $message, $level = 'success', $button = 'Okay')
    {
        $this->create($title, $message, $level, 0, $button, 'flash_message_overlay');
    }
}
