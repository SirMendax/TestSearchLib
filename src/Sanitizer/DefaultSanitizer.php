<?php


namespace TestSearchLib\src\Sanitizer;

use TestSearchLib\src\Interfaces\SanitizerInterface;

/**
 * Class DefaultSanitizer
 * @package TestSearchLib\src\Sanitizer
 */
class DefaultSanitizer implements SanitizerInterface
{
  /**
   * @var array|null
   */
  private ?array $config = null;

  /**
   * Sanitizer constructor.
   * @param array $config
   */
  public function __construct(array $config)
  {
    $this->config = $config;
  }

  /**
   * @param int $size
   * @return bool
   */
  public function maxSize(int $size): bool
  {
    return $size < $this->config['max-size'];
  }

  /**
   * @param string $type
   * @return bool
   */
  public function mimeType(string $type): bool
  {
    foreach ($this->config['mime-type'] as $val)
      if($val === $type) return true;

    return false;
  }

  /**
   * @param string $url
   * @return bool
   */
  public function urlValidate(string $url) :bool
  {
    if(filter_var($url, FILTER_VALIDATE_URL) === false){
      return false;
    }else{
      return true;
    }
  }
}
