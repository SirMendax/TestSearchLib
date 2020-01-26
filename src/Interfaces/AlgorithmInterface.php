<?php


namespace TestSearchLib\src\Interfaces;

/**
 * Interface AlgorithmInterface
 * @package TestSearchLib\src\Interfaces
 */
interface AlgorithmInterface
{
  public static function find(string $file, string $substr) :?array;
}
