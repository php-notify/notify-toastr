<?php

namespace Notify\Toastr\Tests\Notification;

use PHPUnit\Framework\TestCase;
use Notify\Toastr\Notification\Toastr;

class ToastrTest extends TestCase
{
    public function test_simple_case()
    {
        $toastr = new Toastr('success', 'success message', 'success title', array());

        $this->assertEquals('success', $toastr->getType());
        $this->assertEquals('success message', $toastr->getMessage());
        $this->assertEquals('success title', $toastr->getTitle());
        $this->assertEquals(array(), $toastr->getContext());
        $this->assertEquals('toastr.success(\'success message\', \'success title\', []);', $toastr->render());
    }

    public function test_render_with_options()
    {
        $context = array(
            'options' => array(
                'display' => 'top-right',
            ),
        );
        $toastr = new Toastr('success', 'success message', 'success title', $context);

        $this->assertEquals('success', $toastr->getType());
        $this->assertEquals('success message', $toastr->getMessage());
        $this->assertEquals('success title', $toastr->getTitle());
        $this->assertEquals(array('options' => array('display' => 'top-right')), $toastr->getContext());
        $this->assertEquals('toastr.success(\'success message\', \'success title\', {"display":"top-right"});', $toastr->render());
    }
}
