<?php

namespace Notify\Toastr\Producer;

use Notify\Producer\AbstractProducer;

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
