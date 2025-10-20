<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\GooseBoards\Library\BoardGenerator;

use App\Modules\GooseBoards\Library\BoardGenerator\GooseBoardBoardGenerator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class GooseBoardBoardGeneratorTest extends TestCase
{
    private function makeInstance(): GooseBoardBoardGenerator
    {
        $ref = new ReflectionClass(GooseBoardBoardGenerator::class);

        /** @var GooseBoardBoardGenerator $instance */
        $instance = $ref->newInstanceWithoutConstructor();

        return $instance;
    }

    private function invoke(object $object, string $method, array $args = [])
    {
        $ref = new ReflectionClass($object);
        $m = $ref->getMethod($method);
        $m->setAccessible(true);

        return $m->invokeArgs($object, $args);
    }

    #[Test]
    public function ComputeImageDimensions(): void
    {
        $sut = $this->makeInstance();

        [$w1, $h1] = $this->invoke($sut, 'computeImageDimensions', [0]);
        $this->assertSame(6 * 250, $w1);
        $this->assertSame(1 * 250, $h1, 'At least one row tall even if 0 tiles');

        [$wCycle, $hCycle] = $this->invoke($sut, 'computeImageDimensions', [8]);
        $this->assertSame(6 * 250, $wCycle);
        $this->assertSame(2 * 250, $hCycle, 'Exactly one cycle for 8 tiles (6+2)');

        [$w2, $h2] = $this->invoke($sut, 'computeImageDimensions', [12]);
        $this->assertSame(6 * 250, $w2);
        $this->assertSame(4 * 250, $h2, 'Two cycles tall for 12 tiles');

        [$w3, $h3] = $this->invoke($sut, 'computeImageDimensions', [13]);
        $this->assertSame(6 * 250, $w3);
        $this->assertSame(4 * 250, $h3, 'Two cycles tall for 13 tiles');
    }

    #[Test]
    public function ShouldRunHorizontally(): void
    {
        $sut = $this->makeInstance();

        $this->assertTrue($this->invoke($sut, 'shouldRunHorizontally', [0]));
        $this->assertTrue($this->invoke($sut, 'shouldRunHorizontally', [5]));
        $this->assertFalse($this->invoke($sut, 'shouldRunHorizontally', [6]));
        $this->assertFalse($this->invoke($sut, 'shouldRunHorizontally', [7]));
    }

    #[Test]
    public function HorizontalCoordinatesRightAndLeft(): void
    {
        $sut = $this->makeInstance();

        // Row start at xGrid=0, yGrid=0 going right
        [$x0, $y0] = $this->invoke($sut, 'getHorizontalCoordinates', [0, 'right', 0, 0]);
        $this->assertSame(0, $x0);
        $this->assertSame(0, $y0);

        [$x5, $y5] = $this->invoke($sut, 'getHorizontalCoordinates', [5, 'right', 0, 0]);
        $this->assertSame(5 * 250, $x5);
        $this->assertSame(0, $y5);

        // Going left should mirror within the 6-wide run
        [$xl0, $yl0] = $this->invoke($sut, 'getHorizontalCoordinates', [0, 'left', 0, 0]);
        $this->assertSame(5 * 250, $xl0);
        $this->assertSame(0, $yl0);

        [$xl5, $yl5] = $this->invoke($sut, 'getHorizontalCoordinates', [5, 'left', 0, 0]);
        $this->assertSame(0, $xl5);
        $this->assertSame(0, $yl5);
    }

    #[Test]
    public function VerticalCoordinatesRightAndLeft(): void
    {
        $sut = $this->makeInstance();

        // First vertical step after horizontal run when direction is right
        [$xr, $yr] = $this->invoke($sut, 'getVerticalCoordinates', [6, 'right', 0, 0]);
        $this->assertSame((6 - 1) * 250, $xr);
        $this->assertSame(1 * 250, $yr);

        // First vertical step after horizontal run when direction is left
        [$xl, $yl] = $this->invoke($sut, 'getVerticalCoordinates', [6, 'left', 0, 0]);
        $this->assertSame(0, $xl);
        $this->assertSame(1 * 250, $yl);

        // Second vertical step in the run
        [$xr2, $yr2] = $this->invoke($sut, 'getVerticalCoordinates', [7, 'right', 0, 0]);
        $this->assertSame((6 - 1) * 250, $xr2);
        $this->assertSame(2 * 250, $yr2);
    }

    #[Test]
    public function DrawTileHandlesNullImageUrl(): void
    {
        $sut = $this->makeInstance();

        // Create base image canvas the size of one tile
        $canvas = imagecreatetruecolor(250, 250);
        $colors = $this->invoke($sut, 'allocateColors', [$canvas]);

        // Should not throw
        $this->invoke($sut, 'drawTile', [$canvas, 0, 0, $colors, 1, null]);

        imagedestroy($canvas);
        $this->assertTrue(true);
    }

    #[Test]
    public function DrawTileOverlaysImageFromUrl(): void
    {
        $sut = $this->makeInstance();

        // Create a canvas and get colors
        $canvas = imagecreatetruecolor(250, 250);
        $colors = $this->invoke($sut, 'allocateColors', [$canvas]);

        // Draw a bright red source image and save to a temp file
        $src = imagecreatetruecolor(20, 20);
        $red = imagecolorallocate($src, 255, 0, 0);
        imagefilledrectangle($src, 0, 0, 19, 19, $red);

        $tmp = tempnam(sys_get_temp_dir(), 'gbg');
        // Ensure PNG
        imagepng($src, $tmp);
        imagedestroy($src);

        $url = 'file://'.$tmp;

        // Draw tile with overlay
        $this->invoke($sut, 'drawTile', [$canvas, 0, 0, $colors, 1, $url]);

        // Check center pixel is red-ish (not the square background color 234,221,202)
        $centerColor = imagecolorat($canvas, 125, 125);
        $squareColor = $colors['square'];
        unlink($tmp);
        imagedestroy($canvas);

        $this->assertNotSame($squareColor, $centerColor, 'Center pixel should be affected by overlay image');
    }
}
