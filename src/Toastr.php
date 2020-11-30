<?php

namespace Notify\Toastr;

use Notify\Notification\Notification;

final class Toastr extends Notification
{
    /**
     * @var string
     */
    private $title;

    public function __construct($message = null, $title = null, $type = self::TYPE_SUCCESS, array $options = array())
    {
        parent::__construct($message, $type, $options);

        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
