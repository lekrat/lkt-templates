<?php

namespace Lkt\Templates;

use Lkt\InstancePatterns\AbstractInstances\AbstractParserInstance;
use Lkt\InstancePatterns\Traits\InstantiableTrait;
use function Lkt\Tools\System\isAbsolutePath;

/**
 * Class Template
 * @package Lkt\Templates
 */
class Template extends AbstractParserInstance
{
    use InstantiableTrait;

    protected $file = '';
    protected $data = [];

    /**
     * Template constructor.
     * @param string $name
     * @param array $data
     */
    public function __construct(string $name, array $data = [])
    {
        $name = trim($name);
        if (isAbsolutePath($name)) {
            $this->file = $name;
        } else {
            $this->file = __DIR__ . '/' . $name;
        }

        foreach ($data as $key => $datum){
            $this->set($key, $datum);
        }
    }

    /**
     * @param string $key
     * @param null $value
     */
    public function set(string $key, $value = null)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return string
     */
    public function parse() :string
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
}
