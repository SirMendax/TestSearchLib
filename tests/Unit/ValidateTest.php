<?php

use PHPUnit\Framework\TestCase;
use TestSearchLib\src\Interfaces\SanitizerInterface;
use TestSearchLib\src\Sanitizer\DefaultSanitizer;

final class ValidateTest extends TestCase
{
  private ?array $config = null;
  private ?SanitizerInterface $sanitizer = null;

  protected function setUp(): void
  {
    $this->config = yaml_parse_file('src/config/configuration.yaml');
    $this->sanitizer = new DefaultSanitizer($this->config);
  }

  public function testMaxSize() :void
  {
    $this->assertFalse($this->sanitizer->maxSize(1048579));
    $this->assertTrue($this->sanitizer->maxSize(104850));
    $this->assertTrue($this->sanitizer->maxSize(0));
    $this->assertTrue($this->sanitizer->maxSize(-100));
  }

  public function testValidateMimeType(): void
  {
    $this->assertTrue($this->sanitizer->mimeType('text/html'));
    $this->assertTrue($this->sanitizer->mimeType('text/css'));
    $this->assertTrue($this->sanitizer->mimeType('text/plain'));

    $this->assertFalse($this->sanitizer->mimeType('text'));
    $this->assertFalse($this->sanitizer->mimeType('html'));
    $this->assertFalse($this->sanitizer->mimeType('application/javascript'));

  }

  public function testValidUrl(): void
  {
    $this->assertTrue($this->sanitizer->urlValidate('https://vk.com'));
    $this->assertFalse($this->sanitizer->urlValidate('htt//vk'));
  }
}
