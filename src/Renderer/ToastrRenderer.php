<?php

namespace Notify\Toastr\Renderer;

use Notify\Envelope\Envelope;
use Notify\Renderer\HasGlobalOptionsInterface;
use Notify\Renderer\HasScriptsInterface;
use Notify\Renderer\HasStylesInterface;
use Notify\Renderer\RendererInterface;

class ToastrRenderer implements RendererInterface, HasScriptsInterface, HasStylesInterface, HasGlobalOptionsInterface
{
    private $scripts;
    private $styles;
    private $globalOptions;

    public function __construct(array $scripts = array(), array $styles = array(), array $globalOptions = array())
    {
        $this->scripts       = $scripts;
        $this->styles        = $styles;
        $this->globalOptions = $globalOptions;
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
        return sprintf('toastr.options = %s;', json_encode($this->globalOptions));
    }
}
