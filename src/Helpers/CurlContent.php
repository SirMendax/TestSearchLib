<?php


namespace TestSearchLib\src\Helpers;


use TestSearchLib\src\Exceptions\NotFoundException;

/**
 * Class CurlContent
 * @package TestSearchLib\src\Helpers
 */
final class CurlContent
{
  /**
   * @param string $url
   * @return array
   * @throws NotFoundException
   */
  public static function getCurl(string $url) :array
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, TRUE);
    curl_exec($curl);
    $size = curl_getinfo($curl, CURLINFO_SIZE_DOWNLOAD);
    $type = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if($code === 404){
      throw new NotFoundException('File not found');
    }
    $content = file_get_contents($url);
    return [
      'content' => $content,
      'size' => $size,
      'type' => strstr($type, ';',true)
    ];
  }
}
