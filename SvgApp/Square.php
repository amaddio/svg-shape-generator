<?php

namespace SvgApp;

class Square extends Shape {

    /**
     * @var int|mixed
     */
    private $stride;

    public function __construct($x=0, $y=0, $color="#000000", $stride=0) {
        parent::__construct($x, $y, $color);
        $this->stride = $stride;
    }

    public function toSVGString(): string
    {
        return "<rect x='$this->x' y='$this->y' width='$this->stride' height='$this->stride' style='fill: $this->fill; stroke: $this->stroke; stroke-width: $this->strokeWidth' />";
    }

    public function length(): int
    {
        return 4 * $this->stride;
    }
}