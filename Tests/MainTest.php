<?php
use PHPUnit\Framework\TestCase;

final class MainTest extends TestCase
{
    public function testWhenMainScriptIsCalledWithWrongArgumentsThenItShouldExitWithTheCorrectErrorMessage(): void
    {
        # call the main.php script with wrong arguments and see if the correct error message is printed
        $output=null;
        $retval=null;
        exec('php ../main.php', $output, $retval);
        $this->assertSame(1, $retval);
        $this->assertSame("Usage: php main.php input.shapes output.svg", $output[0]);

        $output=null;
        $retval=null;
        # start with no existing input file
        exec('php ../main.php notexistingfile.shapes foobar.svg', $output, $retval);
        $this->assertSame(1, $retval);
        $this->assertSame("File does not exist. Please provide a valid input file. Check the path and retry.", $output[0]);
    }

    public function testWhenValidInputFileIsPassedThenTheOutputFileShouldHaveExpectedFormat(): void
    {
        # run this command: php main.php input.shapes output.svg
        $output=null;
        $retval=null;
        exec('php ../main.php input.shapes generated.svg', $output, $retval);
        # Read content of generated.svg. The result must be the same as the expected.svg file.
        $generatedLines = file_get_contents('generated.svg', FILE_IGNORE_NEW_LINES);

        # assert that generated lines and expeted lines are the same
        $this->assertStringEqualsFile('test_files/expected_output.svg', $generatedLines);
        $this->assertSame(0, $retval);
    }
}
