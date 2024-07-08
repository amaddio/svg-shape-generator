<?php

namespace SvgApp;

class Circle extends Shape {     # circle
    private $diameter;

    public function __construct($x=0, $y=0, $color="#000000", $diameter=0) {
        parent::__construct($x, $y, $color);
        $this->diameter = $diameter;
    }

    public function toSVGString(): string
    {
        return "<circle cx='$this->x' cy='$this->y' r='$this->diameter' fill='$this->fill' stroke='$this->stroke' stroke-width='$this->strokeWidth' />";
    }

    public function length(): int
    {
        return 2 * pi() * $this->diameter;
    }
}
