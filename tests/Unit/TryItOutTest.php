<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class TryItOutTest extends ApplicationCase
{
    #[Test]
    public function try_it_out()
    {
        $tileSize = 50;        // width and height of each tile
        $totalTiles = 25;     // total number of tiles
        $tileCounter = 1;

// Estimated max size (adjust if needed)
        $imgWidth = 4 * $tileSize;
        $imgHeight = ceil($totalTiles / 2) * $tileSize;

        $image = imagecreatetruecolor($imgWidth, $imgHeight);

// Colors
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        $gray = imagecolorallocate($image, 220, 220, 220);

// Fill background
        imagefill($image, 0, 0, $white);

// Starting position
        $x = 0;
        $y = 0;
        $direction = 'right';

// Main loop
        while ($tileCounter <= $totalTiles) {
            // --- Horizontal (4 tiles) ---
            for ($i = 0; $i < 4 && $tileCounter <= $totalTiles; $i++) {
                if ($direction === 'right') {
                    $drawX = ($x + $i) * $tileSize;
                } else {
                    $drawX = ($x + (3 - $i)) * $tileSize;
                }

                $drawY = $y * $tileSize;

                // Draw tile background
                imagefilledrectangle($image, $drawX, $drawY, $drawX + $tileSize, $drawY + $tileSize, $gray);
                // Draw border
                imagerectangle($image, $drawX, $drawY, $drawX + $tileSize, $drawY + $tileSize, $black);
                // Draw number
                imagestring($image, 3, $drawX + 5, $drawY + 5, $tileCounter, $black);

                $tileCounter++;
            }

            // Update horizontal direction
            $direction = ($direction === 'right') ? 'left' : 'right';

            // --- Vertical (3 tiles) ---
            for ($j = 1; $j <= 3 && $tileCounter <= $totalTiles; $j++) {
                $drawY = ($y + $j) * $tileSize;

                // Horizontal position stays same at edge
                if ($direction === 'right') {
                    $drawX = $x * $tileSize;
                } else {
                    $drawX = ($x + 3) * $tileSize;
                }

                // Draw tile background
                imagefilledrectangle($image, $drawX, $drawY, $drawX + $tileSize, $drawY + $tileSize, $gray);
                // Draw border
                imagerectangle($image, $drawX, $drawY, $drawX + $tileSize, $drawY + $tileSize, $black);
                // Draw number
                imagestring($image, 3, $drawX + 5, $drawY + 5, $tileCounter, $black);

                $tileCounter++;
            }

            // Move Y position down by 3
            $y += 3;
        }

        $filename = 'board_'.now()->timestamp.'.png';
        $path = storage_path('app/public/'.$filename); // Store in storage/app/public/

        imagepng($image, $path); // Save PNG
    }
}
