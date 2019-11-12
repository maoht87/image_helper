<?php

namespace Omt\ImageHelper\Imagick\Commands;

use Omt\ImageHelper\Commands\AbstractCommand;

class InvertCommand extends AbstractCommand
{
    /**
     * Inverts colors of an image
     *
     * @param  \Omt\ImageHelper\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        return $image->getCore()->negateImage(false);
    }
}