<?php

namespace TestSearchLib\src\Interfaces;

/**
 * Interface SearchInterface
 * @package TestSearchLib\src\Interfaces
 */
interface SearchInterface
{
  /**
   * @param string $file
   * @param string $substr
   * @return array|bool
   */
  public function run(string $file, string $substr) :?array;
}
