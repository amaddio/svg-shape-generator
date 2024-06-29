<?php

namespace SvgApp;

abstract class ShapeFile {
    abstract protected function getValue();
    abstract protected function save($shape);
    public function getContent() {
        print $this->getValue() . "\n";
    }
}