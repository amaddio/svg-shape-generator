#!/usr/bin/php
<?php

use SvgApp\ShapeFactory;
use SvgApp\Exceptions\InputFileFormatException;
use SvgApp\SVGFile;

require __DIR__ . '/vendor/autoload.php';

# main function that is called from the command line and takes two arguments.
# - input file path
# - output file path
# When executed as `php main.php input.shapes output.svg` it will:
# 1. Create an svg file that represents these shapes, saved to disk.
# 2. Print out the sum of lengths of all shapes
if (count($argv) != 3) {
    echo "Usage: php main.php input.shapes output.svg\n";
    exit(1);
}
$input = $argv[1];
$output = $argv[2];
# check if the path of the output file is writable and does exist
if (!is_writable(dirname($output))) {
    echo "Output file path: '$output' is not writable or does not exist\n";
    exit(1);
}

if (!file_exists($input)) {
    echo "File does not exist. Please provide a valid input file. Check the path and retry.";
    exit(1);
}

if (!is_readable($input)) {
    echo "File is not readable. Check file permissions and retry.";
    exit(1);
}

try {
    $lines = file($input, FILE_IGNORE_NEW_LINES);
} catch (Exception $e) {
    echo "There was an unexpected error reading the file. Verify that the file is not corrupted.\nError:" . $e->getMessage();
    exit(1);
}
$svg = new SVGFile();
$sum = 0;

$number_of_lines = count($lines);

for ($i = 0; $i < $number_of_lines; $i++) {
    $shape = explode(" ", $lines[$i]);
    try {
        $svg->addShape( ShapeFactory::create($shape) );
    } catch (InputFileFormatException $e) {
        echo "Line " . $i . " will be ignored. " . $e->getMessage() . "\n";
        continue;
    }
}

$svg->saveToFile($output);
echo "Sum of all shape lengths: " . $svg->getSumOfLengths() . "\n";
