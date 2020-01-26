<?php

use PHPUnit\Framework\TestCase;
use TestSearchLib\src\App;
use TestSearchLib\src\Exceptions\MimeTypeException;
use TestSearchLib\src\Exceptions\SizeLimitException;
use TestSearchLib\src\Exceptions\UndefinedSearchException;

class HashSearchInLocalTest extends TestCase
{
  /**
   * @throws UndefinedSearchException
   */
  public function testSearch()
  {
    $file = __DIR__. "/test.txt";

    $searcher = App::builder('local','hash');
    $result = $searcher->run($file, 'camel');
    $this->assertTrue($result['status']);

    $result = $searcher->run($file, 'officia');
    $this->assertEquals(13, $result['line']);

    $result = $searcher->run($file, 'camel');
    $this->assertNotNull($result);
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testMimeTypeException()
  {
    $this->expectException(MimeTypeException::class);
    $jsFile = __DIR__ . "/GreyJohn.jpg";

    $localSearch = App::builder('local','hash');
    $result = $localSearch->run($jsFile, 'console');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testSizeLimitException()
  {
    $this->expectException(SizeLimitException::class);
    $jsFile = __DIR__ . "/Cyri.jpg";

    $localSearch = App::builder('local','hash');
    $result = $localSearch->run($jsFile, 'console');
  }
}
