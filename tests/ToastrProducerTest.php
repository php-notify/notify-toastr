<?php

namespace Notify\Toastr\Tests;

use Notify\Producer\ProducerManager;
use Notify\Toastr\Toastr;
use Notify\Toastr\ToastrProducer;
use PHPUnit\Framework\TestCase;

class ToastrProducerTest extends TestCase
{
    public function testSupports()
    {
        $config = $this->getMock('\Notify\Config\ConfigInterface');
        $manager = new ProducerManager($config);
        $manager->addDriver(new ToastrProducer());

        $producer = $manager->make('toastr');
        $this->assertInstanceOf('\Notify\Toastr\ToastrProducer', $producer);

        $producer = $manager->make('Notify\Toastr\ToastrProducer');
        $this->assertInstanceOf('Notify\Toastr\ToastrProducer', $producer);

        $producer = $manager->make(null, array('notification' => new Toastr()));
        $this->assertInstanceOf('Notify\Toastr\ToastrProducer', $producer);

        $producer = $manager->make(array('notification' => new Toastr()));
        $this->assertInstanceOf('Notify\Toastr\ToastrProducer', $producer);
    }

    public function testCreateNotification()
    {
        $config = $this->getMock('\Notify\Config\ConfigInterface');
        $manager = new ProducerManager($config);
        $manager->addDriver(new ToastrProducer());
        $producer = $manager->make('Notify\Toastr\ToastrProducer');

        $this->assertInstanceOf('Notify\Toastr\Toastr', $producer->createNotification());
        $this->assertInstanceOf('Notify\Toastr\ToastrBuilder', $producer->createNotificationBuilder());

        $notification = $producer
            ->title('fake title')
            ->success('fake message')
            ->getNotification()
        ;

        $this->assertInstanceOf('Notify\Toastr\Toastr', $notification);
        $this->assertSame('fake title', $notification->getTitle());
        $this->assertSame('fake message', $notification->getMessage());
        $this->assertSame('success', $notification->getType());
        $this->assertSame(array(), $notification->getOptions());
    }
}
