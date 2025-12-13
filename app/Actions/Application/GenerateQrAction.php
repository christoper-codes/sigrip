<?php

namespace App\Actions\Application;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Storage;

final class GenerateQrAction
{
    public function execute(string $url, string $slug)
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qr_code = $writer->writeString($url);
        Storage::disk('public')->put("qrs/{$slug}.svg", $qr_code);
    }
}
