<?php

namespace App\Modules\GooseBoards\Library\BoardGenerator;

use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Tile;
use GdImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * This is a horrible class and I hate it.
 */
class GooseBoardBoardGenerator
{
    protected const TILE_SIZE = 250;

    protected const HORIZONTAL_RUN = 6;

    protected const VERTICAL_RUN = 2;

    /**
     * @var Collection<int, Tile>
     */
    protected Collection $tiles;

    public readonly string $filename;

    public function __construct(
        protected GooseBoard $gooseBoard
    ) {
        $this->tiles = $gooseBoard->load('tiles')->tiles;

        $this->filename = $this->generate();
    }

    protected function generate(): string
    {
        [$imgWidth, $imgHeight] = $this->computeImageDimensions($this->tiles->count());

        $image = imagecreatetruecolor($imgWidth, $imgHeight);

        imagefill($image, 0, 0, $this->allocateColors($image)['background']);

        $xGrid = 0;
        $yGrid = 0;
        $direction = 'right';

        $this->tiles->each(function (Tile $tile, int $index) use ($image, &$xGrid, &$yGrid, &$direction) {
            $cycleLength = $this->getCycleLength();
            $positionInCycle = $index % $cycleLength;

            if ($this->shouldRunHorizontally($positionInCycle)) {
                [$drawX, $drawY] = $this->getHorizontalCoordinates($positionInCycle, $direction, $xGrid, $yGrid);
            } else {
                [$drawX, $drawY] = $this->getVerticalCoordinates(
                    $positionInCycle,
                    $direction,
                    $xGrid,
                    $yGrid,
                );
            }

            $this->drawTile(
                image: $image,
                xPx: $drawX,
                yPx: $drawY,
                colors: $this->allocateColors($image),
                label: $index + 1,
                imageUrl: $tile->image_url,
            );

            if (($index + 1) % $cycleLength === 0) {
                $yGrid += self::VERTICAL_RUN;
                $direction = ($direction === 'right') ? 'left' : 'right';
            }
        });

        $filename = Str::of('board-')
            ->append(Carbon::now()->toDateString())
            ->append('-')
            ->append(Str::slug($this->gooseBoard->name))
            ->append('.png')
            ->value();

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        Storage::disk('public')->put($filename, $imageData);

        return $filename;
    }

    protected function shouldRunHorizontally(int $positionInCycle): bool
    {
        return $positionInCycle < self::HORIZONTAL_RUN;
    }

    /**
     * @return array{0:int,1:int} [width, height] in pixels
     */
    protected function computeImageDimensions(int $totalTiles): array
    {
        $width = self::HORIZONTAL_RUN * self::TILE_SIZE;

        $cycles = (int) ceil($totalTiles / (self::HORIZONTAL_RUN + self::VERTICAL_RUN));
        $height = max(1, $cycles * self::VERTICAL_RUN) * self::TILE_SIZE;

        return [$width, $height];
    }

    /**
     * @param GdImage $image
     * @return array{background: false|int, black: false|int, square: false|int}
     */
    protected function allocateColors(GdImage $image): array
    {
        return [
            'background' => imagecolorallocate($image, 72, 60, 50),
            'black' => imagecolorallocate($image, 0, 0, 0),
            'square' => imagecolorallocate($image, 234, 221, 202),
        ];
    }

    /**
     * @param array{background: false|int, black: false|int, square: false|int} $colors
     */
    protected function drawTile(
        GdImage $image,
        int $xPx,
        int $yPx,
        array $colors,
        int $label,
        ?string $imageUrl = null,
    ): void {
        imagefilledrectangle($image, $xPx, $yPx, $xPx + self::TILE_SIZE, $yPx + self::TILE_SIZE, $colors['square']);
        $this->addImageUrl($imageUrl, $xPx, $yPx, $image);
        imagerectangle($image, $xPx, $yPx, $xPx + self::TILE_SIZE, $yPx + self::TILE_SIZE, $colors['black']);
        imagestring($image, 3, $xPx + 5, $yPx + 5, (string) $label, $colors['black']);
    }

    protected function getCycleLength(): int
    {
        return self::HORIZONTAL_RUN + self::VERTICAL_RUN;
    }

    /**
     * @param 'left'|'right' $direction
     * @return array{0:int,1:int}
     */
    protected function getVerticalCoordinates(int $positionInCycle, string $direction, int $xGrid, int $yGrid): array
    {
        $j = $positionInCycle - self::HORIZONTAL_RUN;
        $column = ($direction === 'right') ? $xGrid + self::HORIZONTAL_RUN - 1 : $xGrid;
        $drawX = $column * self::TILE_SIZE;
        $drawY = ($yGrid + $j + 1) * self::TILE_SIZE;

        return [$drawX, $drawY];
    }

    /**
     * @param 'left'|'right' $direction
     * @return array{0:int,1:int}
     */
    protected function getHorizontalCoordinates(int $positionInCycle, string $direction, int $xGrid, int $yGrid): array
    {
        $columnIndex = ($direction === 'right')
            ? ($xGrid + $positionInCycle)
            : ($xGrid + (self::HORIZONTAL_RUN - 1 - $positionInCycle));

        $drawX = $columnIndex * self::TILE_SIZE;
        $drawY = $yGrid * self::TILE_SIZE;

        return [$drawX, $drawY];
    }

    protected function addImageUrl(?string $imageUrl, int $xPx, int $yPx, GdImage $image): void
    {
        if ($imageUrl === null || $imageUrl === '') {
            return;
        }

        $contents = @file_get_contents($imageUrl);

        if ($contents === false) {
            return;
        }

        $src = @imagecreatefromstring($contents);

        if (!$src instanceof GdImage) {
            return;
        }

        $srcW = imagesx($src);
        $srcH = imagesy($src);

        if ($srcW > 0 && $srcH > 0) {
            $padding = 10;
            $dstW = self::TILE_SIZE - (2 * $padding);
            $dstH = self::TILE_SIZE - (2 * $padding);

            $scale = min($dstW / $srcW, $dstH / $srcH);
            $newW = (int)floor($srcW * $scale);
            $newH = (int)floor($srcH * $scale);

            $offsetX = $xPx + (int)floor((self::TILE_SIZE - $newW) / 2);
            $offsetY = $yPx + (int)floor((self::TILE_SIZE - $newH) / 2);

            imagealphablending($image, true);
            imagesavealpha($image, true);

            imagecopyresampled(
                $image,
                $src,
                $offsetX,
                $offsetY,
                0,
                0,
                $newW,
                $newH,
                $srcW,
                $srcH
            );
        }

        imagedestroy($src);
    }
}
