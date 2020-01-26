<?php

namespace TestSearchLib\src\Modules;

use TestSearchLib\src\Exceptions\InvalidUrlException;
use TestSearchLib\src\Exceptions\MimeTypeException;
use TestSearchLib\src\Exceptions\NotFoundException;
use TestSearchLib\src\Exceptions\SizeLimitException;
use TestSearchLib\src\Helpers\CurlContent;
use TestSearchLib\src\Interfaces\AlgorithmInterface;
use TestSearchLib\src\Interfaces\SanitizerInterface;
use TestSearchLib\src\Interfaces\SearchInterface;

/**
 * Class RemoteModule
 * The code search in remote-files
 * @package TestSearchLib\src\Modules
 */
class RemoteModule implements SearchInterface
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
   * SearchInSite constructor.
   * @param SanitizerInterface $sanitizer
   * @param AlgorithmInterface $algorithm
   */
  public function __construct(SanitizerInterface $sanitizer, AlgorithmInterface $algorithm)
  {
    $this->sanitizer = $sanitizer;
    $this->algorithm = $algorithm;
  }

  /**
   * @param string $url
   * @param string $str
   * @return array|bool
   * @throws InvalidUrlException
   * @throws MimeTypeException
   * @throws SizeLimitException
   * @throws NotFoundException
   */
  public function run(string $url, string $str): ?array
  {
    if(!$this->sanitizer->urlValidate($url)) {
      throw new InvalidUrlException('Url is incorrect');
    }

    $file = CurlContent::getCurl($url);

    if($file['code'] === 404){
      throw new NotFoundException('File not found');
    }

    if (!$this->sanitizer->maxSize($file['size'])) {
      throw new SizeLimitException('Maximum file size is overtop');
    }

    if(!$this->sanitizer->mimeType($file['type'])) {
      throw new MimeTypeException('Incorrect mime type');
    }

    return $this->algorithm::find($file['content'], $str);
  }

}
