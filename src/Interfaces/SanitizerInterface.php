<?php


namespace TestSearchLib\src\Interfaces;

/**
 * Interface SanitizerInterface
 * @package TestSearchLib\src\Interfaces
 */
interface SanitizerInterface
{
  /**
   * @param string $type
   * @return bool
   */
  public function mimeType(string $type) :bool;

  /**
   * @param int $size
   * @return bool
   */
  public function maxSize(int $size) :bool;

  /**
   * @param string $url
   * @return bool
   */
  public function urlValidate(string $url) :bool;
}
