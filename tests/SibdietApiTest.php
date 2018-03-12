<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SadeghPM\Sibdiet\Exception\SibdietException;
use SadeghPM\Sibdiet\SibdietApi;

class SibdietApiTest extends TestCase
{
    /**
     * @var SibdietApi
     */
    private $sibdietApi;

    public function testGetUserProfile()
    {
        $this->sibdietApi->setApiKey('invalid');
        $this->expectException(SibdietException::class);
        $this->sibdietApi->getUserProfile(456789);
    }

    protected function setUp()
    {
        $this->sibdietApi = new SibdietApi();
    }
}
