<?php

namespace SvgApp;

class Line extends Shape {

    /**
     * @var int|mixed
     */
    private $x2;

    /**
     * @var int|mixed
     */
    private $y2;

    public function __construct($x=0, $y=0, $x2=0, $y2=0, $color="#000000") {
        parent::__construct($x, $y, $color);
        $this->x2 = $x2;
        $this->y2 = $y2;
    }

    public function toSVGString(): string
    {
        return "<line x1='$this->x' y1='$this->y' x2='$this->x2' y2='$this->y2' style='stroke:$this->stroke; stroke-width:$this->strokeWidth' />";
    }

    public function length(): int
    {
        return sqrt(pow($this->x2 - $this->x, 2) + pow($this->y2 - $this->y, 2));
    }
}
