<?php

namespace SvgApp;

class Rectangle extends Shape {
    private $height;

    private $width;

    public function __construct($x=0, $y=0, $color="#000000", $width=0, $height=0) {
        parent::__construct($x, $y, $color);
        $this->width = $width;
        $this->height = $height;
    }
    public function toSVGString(): string
    {
        return "<rect x='$this->x' y='$this->y' width='$this->width' height='$this->height' style='fill:$this->fill; stroke:$this->stroke; stroke-width:$this->strokeWidth' />";
    }

    public function length(): int
    {
        return 2 * ($this->width + $this->height);
    }
}