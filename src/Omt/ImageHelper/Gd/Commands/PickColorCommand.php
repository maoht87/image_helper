<?php

namespace Omt\ImageHelper\Gd\Commands;

use Omt\ImageHelper\Commands\AbstractCommand;
use Omt\ImageHelper\Gd\Color;

class PickColorCommand extends AbstractCommand
{
    /**
     * Read color information from a certain position
     *
     * @param  \Omt\ImageHelper\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $x = $this->argument(0)->type('digit')->required()->value();
        $y = $this->argument(1)->type('digit')->required()->value();
        $format = $this->argument(2)->type('string')->value('array');

        // pick color
        $color = imagecolorat($image->getCore(), $x, $y);

        if ( ! imageistruecolor($image->getCore())) {
            $color = imagecolorsforindex($image->getCore(), $color);
            $color['alpha'] = round(1 - $color['alpha'] / 127, 2);
        }

        $color = new Color($color);

        // format to output
        $this->setOutput($color->format($format));

        return true;
    }
}
