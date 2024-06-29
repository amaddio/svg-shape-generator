<?php
# ShapeFactory that receives following list of arguments and instanciates the correct shape object with passed arguments
# - sq <X> <Y> <STRIDE> <COLOR>                   # square
# - rt <X> <Y> <WIDTH> <HEIGHT> <COLOR>           # rect
# - cl <X> <Y> <DIAMETER> <COLOR>                 # circle
# - ln <X0> <Y0> <X1> <Y1> <COLOR>                # line
# - pl <X0> <Y0> <X1> <Y1> ... <Xn> <Yn> <COLOR>  # polyline
namespace SvgApp;

use SvgApp\Exceptions\InputFileFormatException;

class ShapeFactory {

    public static $allowedTypes = array("sq", "rt", "cl", "ln", "pl");
    private static $shapeFileIndices = [
    'sq' => [
        'x' => 0,
        'y' => 1,
        'stride' => 2,
        'color' => 3
        ],
      'rt' => [
        'x' => 0,
        'y' => 1,
        'width' => 2,
        'height' => 3,
        'color' => 4
      ],
      'cl' => [
        'x' => 0,
        'y' => 1,
        'diameter' => 2,
        'color' => 3
      ],
      'ln' => [
        'x0' => 0,
        'y0' => 1,
        'x1' => 2,
        'y1' => 3,
        'color' => 4
      ]
    ];

    /**
     * @throws \SvgApp\Exceptions\InputFileFormatException
     */
    public static function create($args)
    {
        $type = array_shift($args);
        $numberOfArguments = count($args);
        try {
            switch ($type) {
                case 'sq':
                    return new Square(
                      $args[self::$shapeFileIndices[$type]['x']],
                      $args[self::$shapeFileIndices[$type]['y']],
                      $args[self::$shapeFileIndices[$type]['color']],
                      $args[self::$shapeFileIndices[$type]['stride']]
                    );
                case 'rt':
                    return new Rectangle(
                      $args[self::$shapeFileIndices[$type]['x']],
                      $args[self::$shapeFileIndices[$type]['y']],
                      $args[self::$shapeFileIndices[$type]['color']],
                      $args[self::$shapeFileIndices[$type]['width']],
                      $args[self::$shapeFileIndices[$type]['height']]
                    );
                case 'cl':
                    return new Circle(
                      $args[self::$shapeFileIndices[$type]['x']],
                      $args[self::$shapeFileIndices[$type]['y']],
                      $args[self::$shapeFileIndices[$type]['color']],
                      $args[self::$shapeFileIndices[$type]['diameter']]
                    );
                case 'ln':
                    return new Line(
                      $args[self::$shapeFileIndices[$type]['x0']],
                      $args[self::$shapeFileIndices[$type]['y0']],
                      $args[self::$shapeFileIndices[$type]['x1']],
                      $args[self::$shapeFileIndices[$type]['y1']],
                      $args[self::$shapeFileIndices[$type]['color']]
                    );
                case 'pl':
                    # A valid polyline configuration must have at least 3 arguments, besides the shape type.
                    if ($numberOfArguments < 4) {
                        throw new InputFileFormatException(
                          "There must be at least 4 arguments for a valid shape type. E.g: 'pl <X0> <Y0> <COLOR>'\nReceived: $args"
                        );
                    }

                    # The last argument is the color.
                    $color = array_pop($args);
                    # The remaining number of arguments must be a division by 2 (Xn, Yn) minus the last argument (=color).
                    if (($numberOfArguments-1) % 2 !== 0) {
                        throw new InputFileFormatException(
                          "Each coordination tupel must contain 2 values (Xn, Yn). Check your values. Received: $args"
                        );
                    }

                    # Every uneven index is an x value and every even index is a y value.
                    $xValues = [];
                    $yValues = [];

                    for ($i = 0; $i < $numberOfArguments-1; $i++) {
                        if ($i % 2 === 0) {
                            $xValues[] = $args[$i];
                        } else {
                            $yValues[] = $args[$i];
                        }
                    }

                    return new Polyline(
                      $xValues,
                      $yValues,
                      $color
                    );
                default:
                    throw new InputFileFormatException(
                      "Invalid shape type: $type. Allowed types: " . implode(
                        ", ",
                        self::$allowedTypes
                      )
                    );
            }
            # TODO: Replace Exception with OutOfBoundsException once implemented. Or upgrade to PHP 8
        } catch (\Exception | InvalidArgumentException $e) {
            throw new InputFileFormatException(
              "Invalid number of arguments for shape type: $type. Expected: " . count(
                self::$shapeFileIndices[$type]
              ) . " Received: " . $numberOfArguments
            );
        }
    }
}
