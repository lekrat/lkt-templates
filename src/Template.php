<?php

namespace Lkt\Templates;

class Template extends BaseTemplate
{
    public static function file(string $templatePath): self
    {
        return new static($templatePath);
    }
}
