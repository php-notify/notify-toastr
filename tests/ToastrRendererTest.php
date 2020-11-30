<?php

namespace Notify\Toastr\Tests;

use Notify\Envelope\Envelope;
use Notify\Envelope\Stamp\CreatedAtStamp;
use Notify\Toastr\Toastr;
use Notify\Toastr\ToastrRenderer;
use PHPUnit\Framework\TestCase;

class ToastrRendererTest extends TestCase
{
    private $renderer;

    protected function setUp()
    {
        $config = $this->getMock('Notify\Config\ConfigInterface');
        $config->expects($this->at(0))->method('get')->with('adapters.toastr.scripts', array())->willReturn(array('jquery.js', 'toastr.js'));
        $config->expects($this->at(1))->method('get')->with('adapters.toastr.styles', array())->willReturn(array('toastr.css'));
        $config->expects($this->at(2))->method('get')->with('adapters.toastr.options', array())->willReturn(array('timer' => 5000));

        $this->renderer = new ToastrRenderer($config);
    }

    public function testGetStyles()
    {
        $styles = $this->renderer->getStyles();
        $this->assertSame(array('toastr.css'), $styles);
    }

    public function testGetScripts()
    {
        $scripts = $this->renderer->getScripts();
        $this->assertSame(array('jquery.js', 'toastr.js'), $scripts);
    }

    public function testRender()
    {
        $notification = new Toastr('fake message', 'fake title', 'success', array('timer' => 3000));
        $envelope = new Envelope($notification, array(new CreatedAtStamp()));
        $output = $this->renderer->render($envelope);

        $this->assertSame("toastr.success('fake message', 'fake title', {\"timer\":3000});", $output);
    }

    public function testRenderOptions()
    {
        $output = $this->renderer->renderOptions();
        $this->assertSame('toastr.options = {"timer":5000};', $output);
    }
}
