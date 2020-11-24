<?php

namespace Notify\Toastr\Renderer;

use Notify\Config\ConfigInterface;
use Notify\Envelope\Envelope;
use Notify\Renderer\HasGlobalOptionsInterface;
use Notify\Renderer\HasScriptsInterface;
use Notify\Renderer\HasStylesInterface;
use Notify\Renderer\RendererInterface;

class ToastrRenderer implements RendererInterface, HasScriptsInterface, HasStylesInterface, HasGlobalOptionsInterface
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
        $context = $envelope->getContext();
        $options = isset($context['options']) ? $context['options'] : array();

        return sprintf(
            "toastr.%s('%s', '%s', %s);",
            $envelope->getType(),
            $envelope->getMessage(),
            $envelope->getTitle(),
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
