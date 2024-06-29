<?php

namespace SvgApp;

use SvgApp\Interfaces\ExportFile;

class SVGFile implements ExportFile
{
    private $shapes = [];

    public function addShape(Shape $shape)
    {
        $this->shapes[] = $shape;
    }

    public function getSumOfLengths() : float
    {
        $sum = 0;
        foreach ($this->shapes as $shape) {
            $sum += $shape->length();
        }
        return $sum;
    }

    public function toSVGString() : string
    {
        $output = "<svg xmlns='http://www.w3.org/2000/svg'>\n";
        foreach ($this->shapes as $shape) {
            $output .= $shape->toSVGString() . "\n";
        }
        $output .= "</svg>";
        return $output;
    }

    public function saveToFile($filename) : bool
    {
        return false !== file_put_contents($filename, $this->toSVGString());
    }
}