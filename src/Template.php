<?php

namespace Lkt\Templates;

use function Lkt\Tools\System\isAbsolutePath;


class Template
{
    protected $file = '';
    protected $data = [];

    /**
     * @param string $templatePath
     * @return static
     */
    public static function file(string $templatePath): self
    {
        return new static($templatePath);
    }

    /**
     * @param string $templatePath
     */
    public function __construct(string $templatePath)
    {
        $templatePath = trim($templatePath);
        if (isAbsolutePath($templatePath)) {
            $this->file = $templatePath;
        } else {
            $this->file = __DIR__ . '/' . $templatePath;
        }
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data = []): self
    {
        foreach ($data as $key => $datum) {
            $this->set($key, $datum);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function set(string $key, $value = null)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->parse();
    }
}
