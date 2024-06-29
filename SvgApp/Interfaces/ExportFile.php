<?php

namespace SvgApp\Interfaces;

interface ExportFile
{
    public function toSVGString(): string;
    public function saveToFile($filename): bool;
}