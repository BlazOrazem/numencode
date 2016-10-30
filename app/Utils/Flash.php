<?php

namespace Numencode\Utils;

class Flash
{
    /**
     * Create a flash message.
     *
     * @param $title
     * @param $message
     * @param $level
     * @param string $key
     * @param null $button
     * @param int $timeout
     */
    public function create($title, $message, $level, $timeout = 3000, $button = null, $key = 'flash_message')
    {
        session()->flash($key, [
            'title' => $title,
            'message' => $message,
            'level' => $level,
            'button' => $button,
            'timeout' => $timeout,
        ]);
    }

    /**
     * Create an information flash message.
     *
     * @param $title
     * @param $message
     * @return void
     */
    public function info($title, $message)
    {
        return $this->create($title, $message, 'info');
    }

    /**
     * Create a success flash message.
     *
     * @param $title
     * @param $message
     * @param $timeout
     * @return void
     */
    public function success($title, $message, $timeout = null)
    {
        return $this->create($title, $message, 'success', $timeout);
    }

    /**
     * Create a warning flash message.
     *
     * @param $title
     * @param $message
     * @return void
     */
    public function warning($title, $message)
    {
        return $this->create($title, $message, 'warning');
    }

    /**
     * Create an error flash message.
     *
     * @param $title
     * @param $message
     * @return void
     */
    public function error($title, $message)
    {
        return $this->create($title, $message, 'error');
    }

    /**
     * Create an overlay flash message.
     *
     * @param $title
     * @param $message
     * @param string $level
     * @param string $button
     */
    public function overlay($title, $message, $level = 'success', $button = 'Okay')
    {
        return $this->create($title, $message, $level, 0, $button, 'flash_message_overlay');
    }
}
