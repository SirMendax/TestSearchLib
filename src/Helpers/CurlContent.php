<?php


namespace TestSearchLib\src\Helpers;


/**
 * Class CurlContent
 * @package TestSearchLib\src\Helpers
 */
final class CurlContent
{
  /**
   * @param string $url
   * @return array
   */
  public static function getCurl(string $url) :array
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, TRUE);
    $content = curl_exec($curl);
    $size = curl_getinfo($curl, CURLINFO_SIZE_DOWNLOAD);
    $type = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    return [
      'code' => $code,
      'content' => $content,
      'size' => $size,
      'type' => strstr($type, ';',true)
    ];
  }
}
