<?php

namespace TestSearchLib\src\Modules;

use TestSearchLib\src\Exceptions\MimeTypeException;
use TestSearchLib\src\Exceptions\SizeLimitException;
use TestSearchLib\src\Interfaces\AlgorithmInterface;
use TestSearchLib\src\Interfaces\SanitizerInterface;
use TestSearchLib\src\Interfaces\SearchInterface;

/**
 * Class LocalModule
 * The code search in local-files
 * @package TestSearchLib\src\Modules
 */
class LocalModule implements SearchInterface
{
  /**
   * @var SanitizerInterface
   */
  private SanitizerInterface $sanitizer;

  /**
   * @var AlgorithmInterface
   */
  private AlgorithmInterface $algorithm;

  /**
   * SearchInLocal constructor.
   * @param SanitizerInterface $sanitizer
   * @param AlgorithmInterface $algorithm
   */
  public function __construct(SanitizerInterface $sanitizer, AlgorithmInterface $algorithm)
  {
    $this->sanitizer = $sanitizer;
    $this->algorithm = $algorithm;
  }

  /**
   * @param string $file
   * @param string $str
   * @return array|bool
   * @throws SizeLimitException
   * @throws MimeTypeException
   */
  public function run(string $file, string $str): ?array
  {
    if(!$this->sanitizer->maxSize(filesize($file))){
      throw new SizeLimitException('Maximum file size is overtop');
    }

    if(!$this->sanitizer->mimeType(mime_content_type($file))){
      throw new MimeTypeException('Incorrect mime type');
    }
    $content = file_get_contents($file);
    return  $this->algorithm::find($content, $str);
  }
}
