<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use DI\ContainerBuilder;

/*
    * StringCalculatorTest class to test the StringCalculator class
    *
    * @category Test
    * @package  App
    */
final class StringCalculatorTest extends TestCase
{
    // declare a public variable to hold the instance of the StringCalculator class
    public $cal;

    /**
     * setUp method to instantiate the StringCalculator class
     */
    function setUp(): void
    {
        error_reporting(E_ALL);

        $container = require __DIR__ . '/../container.php';
        $this->cal = $container->get(App\StringCalculator::class);
    }

    /**
     * Test if the add method of the StringCalculator class returns zero when an empty string is passed.
     *
     * @return void
     */
    public function test_if_add_returns_zero()
    {
        $this->assertEquals(0, $this->cal->add(''));
    }

    /**
     * Test if the add method of the StringCalculator class returns 1 when the string '1' is passed.
     *
     * @return void
     */
    public function test_if_add_returns_1_from_single_number()
    {
        $this->assertEquals(1, $this->cal->add('1'));
    }

    /**
     * Test if the add method of the StringCalculator class returns 5 when the string '3,2' is passed.
     *
     * @return void
     */
    public function test_if_add_returns_five_with_commas_seperated()
    {
        $this->assertEquals(5, $this->cal->add('3,2'));
    }

    /**
     * Test if the add method of the StringCalculator class returns 1 when the string '1' is passed.
     *
     * @return void
     */
    public function test_if_add_returns_one()
    {
        $this->assertEquals(1, $this->cal->add('1'));
    }

    /**
     * Test if the add method of the StringCalculator class returns 6 when the string '1\n2\n3' is passed.
     *
     * @return void
     */
    public function test_if_add_returns_ten_w_newlines_seperator()
    {
        $this->assertEquals(6, $this->cal->add('1\n2\n3'));
    }

    public function test_if_add_returns_ten_w_semicolon_seperator()
    {
        $this->assertEquals(10, $this->cal->add('5;2;3'));
    }

    public function test_if_add_returns_twenty_w_large_seperator()
    {
        $this->assertEquals(10, $this->cal->add('5***2***3'));
    }

    public function test_if_add_returns_twenty_w_large_and_single_seperator()
    {
        $this->assertEquals(10, $this->cal->add('5***2,3'));
    }

    public function test_if_returns_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->cal->add('-5;2;-3');
    }

    public function test_if_returns_exception_for_large_numbers()
    {
        $this->assertEquals(5, $this->cal->add('5000;2;3'));
    }

    public function test_if_add_called_count_is_equal_to_3()
    {
        App\StringCalculator::$addCalledCount = 0;
        try {
            $this->cal->add('5;2;3');
            $this->cal->add('3;2;');
            $this->cal->add('3;-2;');
            $this->cal->add('1;2;');
        } catch (InvalidArgumentException $e) {
        }

        $this->assertEquals(3, $this->cal->getCalledCount());
    }
}