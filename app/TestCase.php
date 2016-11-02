<?php

namespace App;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var TestRunner
     */
    public $html;

    protected function setUp()
    {
        $this->html = new TestRunner();
    }

}