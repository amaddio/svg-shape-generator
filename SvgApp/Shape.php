<?php

namespace SvgApp;

# Base class for all shapes
abstract class Shape {
    public $x;
    public $y;
    public $fill;
    public $stroke;
    public $strokeWidth;

    public function __construct($x=0, $y=0, $color="#000000", $strokeWidth=1) {
        $this->x = $x;
        $this->y = $y;
        $this->stroke = $color;
        $this->fill = $color;
        $this->strokeWidth = $strokeWidth;
    }

    abstract public function toSVGString(): string;

    abstract public function length(): int;
}
