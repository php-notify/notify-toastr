<?php

namespace Notify\Toastr;

use Notify\Notification\NotificationBuilder;

final class ToastrBuilder extends NotificationBuilder
{
    /**
     * @var \Notify\Toastr\Toastr
     */
    protected $notification;

    /**
     * @param \Notify\Toastr\Toastr|null $notification
     */
    public function __construct(Toastr $notification = null)
    {
        parent::__construct($notification ?: new Toastr());
    }

    /**
     * @param string $message
     *
     * @return self
     */
    public function title($message)
    {
        $this->notification->setTitle($message);

        return $this;
    }
}
