<?php

namespace Lkt\Templates;

use function Lkt\Tools\System\isAbsolutePath;

abstract class BaseTemplate
{
    protected string $file = '';
    protected array $data = [];

    public function __construct(?string $templatePath = null)
    {
        if (trim($this->file) !== '' && $templatePath === null) {
            return;
        }
        $templatePath = trim($templatePath);
        if (isAbsolutePath($templatePath)) {
            $this->file = $templatePath;
        } else {
            $this->file = __DIR__ . '/' . $templatePath;
        }
    }

    public function setData(array $data = []): self
    {
        foreach ($data as $key => $datum) {
            $this->set($key, $datum);
        }
        return $this;
    }

    public function set(string $key, $value = null): static
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function parse(): string
    {
        $r = '';
        if (file_exists($this->file)) {
            \ob_start();
            \extract($this->data, \EXTR_OVERWRITE);
            include $this->file;
            $r = \ob_get_contents();
            \ob_end_clean();
        }
        return $r;
    }

    public function __toString(): string
    {
        return $this->parse();
    }
}