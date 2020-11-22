<?php

namespace Notify\Toastr\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Notify\Toastr\Producer\ToastrProducer;

class ToastrFactoryTest extends TestCase
{
    public function test_simple_toastr_factory()
    {
        $factory = new ToastrProducer();

        $this->assertEquals('<script type="application/javascript">
toastr.options = [];
</script>', $factory->render());
        $this->assertEquals(array(), $factory->getNotifications());
        $this->assertEquals(array(), $factory->getScripts());
        $this->assertEquals(array(), $factory->getStyles());
        $this->assertEquals(false, $factory->readyToRender());
    }

    public function test_toastr_factory_with_one_notification()
    {
        $factory = new ToastrProducer();
        $factory->notification('success', 'success message', 'success title');
        $this->assertEquals('<script type="application/javascript">
toastr.options = [];
toastr.success(\'success message\', \'success title\', []);
</script>', $factory->render());
        $this->assertEquals(array(), $factory->getScripts());
        $this->assertEquals(array(), $factory->getStyles());
        $this->assertEquals(true, $factory->readyToRender());
    }

    public function test_toastr_factory_with_one_notification_and_context()
    {
        $factory = new ToastrProducer();
        $factory->notification('success', 'success message', 'success title', array('options' => array(
            'display' => 'top-right',
        )));
        $this->assertEquals('<script type="application/javascript">
toastr.options = [];
toastr.success(\'success message\', \'success title\', {"display":"top-right"});
</script>', $factory->render());
        $this->assertEquals(array(), $factory->getScripts());
        $this->assertEquals(array(), $factory->getStyles());
        $this->assertEquals(true, $factory->readyToRender());
    }

    public function test_toastr_with_config()
    {
        $factory = new ToastrProducer();
        $factory->setConfig(array(
            'scripts' => array('jquery.js', 'notifier.js'),
            'styles' => array('notifier.css'),
            'options' => array(
                'display' => 'top-left',
            ),
        ));
        $this->assertEquals('<script type="application/javascript">
toastr.options = {"display":"top-left"};
</script>', $factory->render());
        $this->assertEquals(array(), $factory->getNotifications());
        $this->assertEquals(array('jquery.js', 'notifier.js'), $factory->getScripts());
        $this->assertEquals(array('notifier.css'), $factory->getStyles());
        $this->assertEquals(false, $factory->readyToRender());
    }

    public function test_success_notification()
    {
        $factory = new ToastrProducer();
        $factory->success('message', 'title');
        $this->assertEquals('<script type="application/javascript">
toastr.options = [];
toastr.success(\'message\', \'title\', []);
</script>', $factory->render());
        $this->assertEquals(array(), $factory->getScripts());
        $this->assertEquals(array(), $factory->getStyles());
        $this->assertEquals(true, $factory->readyToRender());
    }

    public function test_info_notification()
    {
        $factory = new ToastrProducer();
        $factory->info('message', 'title');
        $this->assertEquals('<script type="application/javascript">
toastr.options = [];
toastr.info(\'message\', \'title\', []);
</script>', $factory->render());
        $this->assertEquals(array(), $factory->getScripts());
        $this->assertEquals(array(), $factory->getStyles());
        $this->assertEquals(true, $factory->readyToRender());
    }

    public function test_error_notification()
    {
        $factory = new ToastrProducer();
        $factory->error('message', 'title');
        $this->assertEquals('<script type="application/javascript">
toastr.options = [];
toastr.error(\'message\', \'title\', []);
</script>', $factory->render());
        $this->assertEquals(array(), $factory->getScripts());
        $this->assertEquals(array(), $factory->getStyles());
        $this->assertEquals(true, $factory->readyToRender());
    }

    public function test_warning_notification()
    {
        $factory = new ToastrProducer();
        $factory->warning('message', 'title');
        $this->assertEquals('<script type="application/javascript">
toastr.options = [];
toastr.warning(\'message\', \'title\', []);
</script>', $factory->render());
        $this->assertEquals(array(), $factory->getScripts());
        $this->assertEquals(array(), $factory->getStyles());
        $this->assertEquals(true, $factory->readyToRender());
    }
}
