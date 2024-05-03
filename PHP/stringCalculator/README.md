# TDD Kata 1 - String Calculator

## Introduction

Before you start:
- Try not to read ahead.
- Do one task at a time. The trick is to learn to work incrementally.
- Make sure you only test for correct inputs; there is no need to test for invalid inputs for this kata.
- Test first!

## String Calculator

### Instructions

1. In a test-first manner, create a simple class `StringCalculator` with a method `public int Add(string numbers)`:
   - The method can take 0, 1, or 2 numbers and will return their sum (for an empty string it will return 0).
   - For example:
     - `""` returns `0`
     - `"1"` returns `1`
     - `"1,2"` returns `3`
   - Start with the simplest test case of an empty string and move to one and two numbers.
   - Remember to solve things as simply as possible so that you force yourself to write tests you did not think about.
   - Remember to refactor after each passing test.

2. Allow the `Add` method to handle an unknown amount of numbers.

3. Allow the `Add` method to handle new lines between numbers (instead of commas).
   - Valid input: `"1\n2,3"` returns `6`.
   - Invalid input (do not expect it): `"1,\n"`.

4. Support different delimiters:
   - To change a delimiter, the beginning of the string will contain a separate line that looks like this: `"//[delimiter]\n[numbers…]"`.
   - For example: `"//;\n1;2"` returns `3`.
   - Note: All existing scenarios and tests should still be supported.

5. Calling `Add` with a negative number will throw an exception "negatives not allowed" and the negative that was passed.
   - If there are multiple negatives, show all of them in the exception message.

6. Using TDD, add a method to `StringCalculator` called `public int GetCalledCount()` that returns how many times `Add()` was invoked.
   - Remember - Start with a failing (or even non-compiling) test.

7. (.NET Only) Using TDD, add an event to the `StringCalculator` class named `public event Action<string, int> AddOccurred`, that is triggered after every `Add()` call.
   - Create the event declaration first.
   - Then write a failing test that listens to the event and proves it should have been triggered when calling `Add()`.

8. Numbers bigger than 1000 should be ignored, for example:
   - `2 + 1001` returns `2`.

9. Delimiters can be of any length with the following format: `"//[delimiter]\n"`.
   - For example: `"//[***]\n1***2***3"` returns `6`.

10. Allow multiple delimiters like this: `"//[delim1][delim2]\n"`.
    - For example: `"//[*][%]\n1*2%3"` returns `6.

11. Make sure you can also handle multiple delimiters with length longer than one char.
    - For example: `"//[**][%%]\n1**2%%3"` returns `6.
