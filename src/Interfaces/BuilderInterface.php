<?php


namespace TestSearchLib\src\Interfaces;

/**
 * Interface BuilderInterface
 * @package TestSearchLib\src\Interfaces
 */
interface BuilderInterface
{
  /**
   * @param string $module
   * @param string $algorithm
   * @return SearchInterface
   */
  public static function builder(string $module, string $algorithm) :SearchInterface;
}
