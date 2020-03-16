<?php

namespace Yoeunes\Notify\Toastr\Producer;

use Yoeunes\Notify\Producer\AbstractProducer;

final class ToastrProducer extends AbstractProducer
{
    /**
     * @inheritDoc
     */
    public function getRenderer()
    {
        return 'toastr';
    }
}
