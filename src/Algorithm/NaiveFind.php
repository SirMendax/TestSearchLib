<?php


namespace TestSearchLib\src\Algorithm;

use TestSearchLib\src\Interfaces\AlgorithmInterface;

/**
 * Class NaiveFind
 * The code find string in text
 * @package TestSearchLib\src\Algorithm
 */
final class NaiveFind implements AlgorithmInterface
{
  /**
   * @param string $content
   * @param string $str
   * @return array|null
   */
  public static function find(string $content, string $str) :?array
  {
    $contentInArray = explode(PHP_EOL, $content);
    foreach ($contentInArray as $key => $val) {
      if (preg_match('/\b'.$str.'\b/u', trim($val)) === 1) {
        return [
            'status' => true,
            'line' => $key + 1,
            'position' => strrpos($val, $str)
        ];
      }
    }
    return null;
  }
}
