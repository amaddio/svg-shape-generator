<?php

namespace SvgApp;

class PolyLine extends Shape {
    # - pl <X0> <Y0> <X1> <Y1> ... <Xn> <Yn> <COLOR>  # polyline

    /**
     * @throws \InvalidArgumentException if the number of x and y coordinates are not equal
     */
    public function __construct($x=[0], $y=[0], $color="#000000") {
        parent::__construct($x, $y, $color);
        if (count($x) != count($y)) {
            throw new \InvalidArgumentException("Number of x and y coordinates must be equal");
        }
    }
    public function toSVGString(): string
    {
        $points = "";
        for ($i = 0; $i < count($this->x); $i++) {
            $points .= $this->x[$i] . "," . $this->y[$i] . " ";
        }
        return "<polyline points='$points' style='fill:$this->fill; stroke:$this->stroke; stroke-width:$this->strokeWidth' />";
    }

    public function length(): int
    {
        $length = 0;
        for ($i = 1; $i < count($this->x); $i++) {
            $length += sqrt(pow($this->x[$i] - $this->x[$i-1], 2) + pow($this->y[$i] - $this->y[$i-1], 2));
        }
        return $length;
    }
}
