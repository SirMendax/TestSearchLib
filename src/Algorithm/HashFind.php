<?php


namespace TestSearchLib\src\Algorithm;

use TestSearchLib\src\Interfaces\AlgorithmInterface;

/**
 * Class HashFind
 * The code is realisation of algorithm Rabin-Karp
 * @package TestSearchLib\src\Algorithm
 */
final class HashFind implements AlgorithmInterface
{
  /**
   * The function finds substring in text, which includes more than one string
   * @param string $content
   * @param string $substr
   * @return array|null
   */
  public static function find(string $content, string $substr) :?array
  {
    $contentInArray = explode(PHP_EOL, $content);
    foreach ($contentInArray as $key => $val) {
      $find = self::findInStr($val, $substr);
      if($find !== null){
        return [
          'status' => true,
          'line' => $key+1,
          'position' => $find['position'],
        ];
      }
    }
    return null;
  }

  /**
   * The function finds substring in string. She use algorithm Rabin-Karp
   * @param string $str
   * @param string $substr
   * @return array|null
   */
  public static function findInStr(string $str, string $substr) :?array
  {
    $n = 0;
    $len_str = strlen($str);
    $len_sub = strlen($substr);
    $hash_str = self::hashSum($str, $substr);
    $hash_sub = self::hashSum($substr);

    for ($i = 0; $i <= ($len_str - $len_sub); $i++) {
      $n++;
      if ($hash_str !== $hash_sub) {
        if($len_str === $i+$len_sub) continue;
        $a = ord($str[$i]);
        $b = ord($str[$i + $len_sub]);
        $hash_str = $hash_str - $a + $b;
        continue;
      }
      //Following code (if-condition) resolves the collision that occurs when program using the function 'ord'
      if(substr($str, $i, $len_sub) === $substr){
        return [
          'position' => $i,
          'status' => true,
        ];
      }
    }
    return null;
  }

  /**
   * The function defines hash-sum by ord-function.
   * @param string $str
   * @param string|null $substr
   * @return int
   */
  public static function hashSum(string $str, string $substr = null): int
  {
    $sum = 0;
    if ($substr !== null) {
      $stop = strlen(substr($str, 0, strlen($substr)));
    } else {
      $stop = strlen($str);
    }
    for ($i = 0; $i < $stop; $i++) {
      $sum += ord(substr($str, $i));
    }
    return $sum;
  }

//  public static function rollingHashSum(string $str)
//  {
//
//  }
}
