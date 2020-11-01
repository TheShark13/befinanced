<?php


namespace App\Test\Controller;


use PHPUnit\Framework\TestCase;


class HomeControllerTest extends TestCase
{
    public function testReceiveRequest(): void
    {
        $this->assertEquals(2, 2);
    }
}