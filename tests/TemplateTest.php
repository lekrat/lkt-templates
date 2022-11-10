<?php

namespace Lkt\Templates\Tests;

use Lkt\Templates\Template;
use Lkt\Templates\Tests\assets\AssetTemplate;
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    /**
     * @return void
     */
    public function testTemplateEngine()
    {
        $expected = "<div>Sample</div>
<div>1</div>
<div>2</div>
";
        $template = Template::file(__DIR__ .'/assets/tpl.phtml')
            ->setData(['name' => 'Sample', 'items' => [1,2]]);
        $this->assertEquals($expected, $template->parse());
    }

    /**
     * @return void
     */
    public function testTemplateEngine2()
    {
        $expected = "<div>Sample</div>
<div>1</div>
<div>2</div>
";
        $template = AssetTemplate::data(['name' => 'Sample', 'items' => [1,2]]);
        $this->assertEquals($expected, $template->parse());
    }
}