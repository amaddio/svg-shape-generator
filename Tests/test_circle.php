<?php
use PHPUnit\Framework\TestCase;
use SvgApp\Circle;

final class TestCircle extends TestCase
{
    public function testWhenACircleIsInstantiatedTheSVGIsEqualExpectedResult(): void
    {
        $circle = new Circle(10);
        # call the main.php script with wrong arguments and see if the correct error message is printed
        $this->expectOutputString("Usage: php main.php <shape> <args>\n");
        require 'main.php';
        # $this->assertSame($string, $email->asString());
    }
}
