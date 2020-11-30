<?php

namespace Notify\Toastr;

use Notify\Producer\AbstractProducer;

/**
 * @method \Notify\Toastr\ToastrBuilder title($title)
 */
final class ToastrProducer extends AbstractProducer
{
    /**
     * @inheritDoc
     */
    public function supports($name = null, array $context = array())
    {
        return in_array($name, array('toastr', __CLASS__))
            || (isset($context['notification']) && $context['notification'] instanceof Toastr);
    }

    public function createNotification()
    {
        return new Toastr();
    }

    public function createNotificationBuilder()
    {
        return new ToastrBuilder($this->createNotification());
    }
}
