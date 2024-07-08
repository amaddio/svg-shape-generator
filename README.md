# svg-shape-generator

## Description

Pass a shape file to generate SVGs

## Requirements

- PHP 7.3
  - This software uses deprecated php version (deliberately)! See install sections for more information.
- Composer version 2.7.7

## Command Line Interface

Run the following command to generate an SVG file from a shape file:

```sh
php main.php input.shapes output.svg
```

## File Format Specification

Shapes and formats:
```
- sq <X> <Y> <STRIDE> <COLOR>                   # square
- rt <X> <Y> <WIDTH> <HEIGHT> <COLOR>           # rect
- cl <X> <Y> <DIAMETER> <COLOR>                 # circle
- ln <X0> <Y0> <X1> <Y1> <COLOR>                # line
- pl <X0> <Y0> <X1> <Y1> ... <Xn> <Yn> <COLOR>  # polyline
```

## Unit Tests

Run tests with: `./vendor/bin/phpunit Tests`

## Installation

To get the deprecated PHP version 7.3 up and running you could proceed like this on a Mac:

```bash  
brew install shivammathur/php@7.3
# unink your current php version
brew unlink <brew unlink php@8.3>
brew link shivammathur/php/php@7.3
# install xdebug: https://xdebug.org/docs/compat
pecl install xdebug-3.1.6
```