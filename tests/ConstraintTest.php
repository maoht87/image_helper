<?php

use Omt\ImageHelper\Constraint;
use PHPUnit\Framework\TestCase;

class ConstraintTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testConstructor()
    {
        $size = $this->getMockedSize(800, 600);
        $constraint = new Constraint($size);
        $this->assertInstanceOf('Omt\ImageHelper\Constraint', $constraint);
        $this->assertFalse($constraint->isFixed(Constraint::ASPECTRATIO));
        $this->assertFalse($constraint->isFixed(Constraint::UPSIZE));
    }

    public function testSetOnlyAspectRatio()
    {
        $size = $this->getMockedSize(800, 600);
        $constraint = new Constraint($size);
        $constraint->aspectRatio();
        $this->assertTrue($constraint->isFixed(Constraint::ASPECTRATIO));
        $this->assertFalse($constraint->isFixed(Constraint::UPSIZE));
    }

    public function testSetOnlyUpsize()
    {
        $size = $this->getMockedSize(800, 600);
        $constraint = new Constraint($size);
        $constraint->upsize();
        $this->assertFalse($constraint->isFixed(Constraint::ASPECTRATIO));
        $this->assertTrue($constraint->isFixed(Constraint::UPSIZE));
    }

    public function testSetAspectratioAndUpsize()
    {
        $size = $this->getMockedSize(800, 600);
        $constraint = new Constraint($size);
        $constraint->aspectRatio();
        $constraint->upsize();
        $this->assertTrue($constraint->isFixed(Constraint::ASPECTRATIO));
        $this->assertTrue($constraint->isFixed(Constraint::UPSIZE));
    }

    private function getMockedSize($width, $height)
    {
        $size = Mockery::mock('\Omt\ImageHelper\Size', [$width, $height]);
        $size->shouldReceive('getWidth')->andReturn($width);
        $size->shouldReceive('getHeight')->andReturn($height);
        $size->shouldReceive('getRatio')->andReturn($width/$height);
        return $size;
    }
}
