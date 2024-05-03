<?php

namespace App;

/*
* StringCalculator class
*
* The `StringCalculator` class provides a method to add numbers provided as
* strings, supporting custom delimiters and ignoring numbers larger than a
* specified threshold. The class is designed to be used in environments where
* test-driven development (TDD) is practiced.
*
*/
class StringCalculator
{
    /**
     * Delimiters
     *
     * @var array
     */
    private array $delimiters = [];

    /**
     * Largest calculable number
     *
     * @var int
    */
    private int $largestCalculableNumber;

    /**
     * Add method called count
     *
     * @var int
     */
    public static $addCalledCount = 0;

    public function __construct(array $delimiters, int $largestCalculableNumber)
    {
        $this->delimiters = $delimiters;
        $this->largestCalculableNumber = $largestCalculableNumber;
    }

    /**
     * Add numbers
     *
     * @param string $numberString
     * @return int
     */
    public function add(string $numberString): int
    {
        self::$addCalledCount++;

        $pattern = '/[' . implode('', array_map('preg_quote', $this->delimiters)) . ']/';
        $numbers = array_map('intval', preg_split($pattern, $numberString));

        // check if any number is a negative number
        $this->checkForNegatives($numbers);

        $listOfNumbers = preg_split($pattern, $numberString);

        // remove any number larger than 1000
        $listOfNumbers = $this->stripLargeNumbers($listOfNumbers);

        return ($numberString === '') ? 0: (int) array_sum(array_map('intval', $listOfNumbers));
    }

    /**
     * Checks if the array of numbers contains any negative values.
     *
     * This method filters the array to find any negative numbers. If any are found, it throws an InvalidArgumentException.
     *
     * @param array $numbers The array of numbers to check.
     * @throws \InvalidArgumentException If any negative numbers are found.
     * @return void
     */
    private function checkForNegatives(array $numbers): void
    {
        $negatives = array_filter($numbers, function ($n) {
            return $n < 0;
        });

        if (count($negatives) > 0) {
            throw new \InvalidArgumentException('Negatives not allowed: ' . implode(', ', $negatives));
        }
    }

    /**
     * Strips out any numbers larger than the largestCalculableNumber property.
     *
     * @param array $numbers The array of numbers to filter.
     * @return array The filtered array of numbers.
    */
    private function stripLargeNumbers(array $numbers): array
    {
        return array_filter($numbers, function ($n) {
            return $n < $this->largestCalculableNumber;
        });
    }

    /**
     * Get the number of times the add method was called
     *
     * @return int
    */
    public function getCalledCount(): int
    {
        return self::$addCalledCount;
    }
}