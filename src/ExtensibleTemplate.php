<?php

namespace Lkt\Templates;

class ExtensibleTemplate extends BaseTemplate
{
    public static function data(array $data): self
    {
        return (new static())->setData($data);
    }
}