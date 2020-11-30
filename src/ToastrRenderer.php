<?php

namespace Notify\Toastr;

use Notify\Config\ConfigInterface;
use Notify\Envelope\Envelope;
use Notify\Renderer\HasOptionsInterface;
use Notify\Renderer\HasScriptsInterface;
use Notify\Renderer\HasStylesInterface;
use Notify\Renderer\RendererInterface;

final class ToastrRenderer implements RendererInterface, HasScriptsInterface, HasStylesInterface, HasOptionsInterface
{
    /**
     * @var \Notify\Config\ConfigInterface
     */
    private $config;

    /**
     * @var array
     */
    private $scripts;

    /**
     * @var array
     */
    private $styles;

    /**
     * @var array
     */
    private $options;

    public function __construct(ConfigInterface $config)
    {
        $this->config  = $config;
        $this->scripts = $config->get('adapters.toastr.scripts', array());
        $this->styles  = $config->get('adapters.toastr.styles', array());
        $this->options = $config->get('adapters.toastr.options', array());
    }

    /**
     * @inheritDoc
     */
    public function render(Envelope $envelope)
    {
        /**
         * @var \Notify\Toastr\Toastr $notification
         */
        $notification = $envelope->getNotification();
        $options = $notification->getOptions() ?: array();

        return sprintf(
            "toastr.%s('%s', '%s', %s);",
            $notification->getType(),
            $notification->getMessage(),
            $notification->getTitle(),
            json_encode($options)
        );
    }

    /**
     * @inheritDoc
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * @inheritDoc
     */
    public function getStyles()
    {
        return $this->styles;
    }

    public function renderOptions()
    {
        return sprintf('toastr.options = %s;', json_encode($this->options));
    }
}
