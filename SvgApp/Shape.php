<?php

namespace SvgApp;

# base class for all shapes that to have this members

# Shapes and formats:
# - sq <X> <Y> <STRIDE> <COLOR>                   # square
# - rt <X> <Y> <WIDTH> <HEIGHT> <COLOR>           # rect
# - cl <X> <Y> <DIAMETER> <COLOR>                 # circle
# - ln <X0> <Y0> <X1> <Y1> <COLOR>                # line
# - pl <X0> <Y0> <X1> <Y1> ... <Xn> <Yn> <COLOR>  # polyline

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
