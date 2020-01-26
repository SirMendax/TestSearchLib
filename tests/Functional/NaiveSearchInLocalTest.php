<?php

use TestSearchLib\src\App;
use TestSearchLib\src\Exceptions\MimeTypeException;
use TestSearchLib\src\Exceptions\SizeLimitException;
use TestSearchLib\src\Exceptions\UndefinedSearchException;
use PHPUnit\Framework\TestCase;

class NaiveSearchInLocalTest extends TestCase
{

  /**
   * @throws UndefinedSearchException
   */
  public function testSearch()
  {
    $file = __DIR__. "/test.txt";

    $searcher = App::builder('local', 'naive');
    $result = $searcher->run($file, 'mendax');
    $this->assertEquals(4, $result['line']);

    $result = $searcher->run($file, 'ruby');
    $this->assertNull($result);

    $result = $searcher->run($file, 'officia');
    $this->assertEquals(13, $result['line']);

    $result = $searcher->run($file, 'kurwa');
    $this->assertNull($result);

    $result = $searcher->run($file, 'lorem');
    $this->assertNull($result);

  }

  /**
   * @throws UndefinedSearchException
   */
  public function testMimeTypeException()
  {
    $this->expectException(MimeTypeException::class);
    $jsFile = __DIR__ . "/GreyJohn.jpg";

    $localSearch = App::builder('local', 'naive');
    $localSearch->run($jsFile, 'console');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testSizeLimitException()
  {
    $this->expectException(SizeLimitException::class);
    $jsFile = __DIR__ . "/Cyri.jpg";

    $localSearch = App::builder('local', 'naive');
    $localSearch->run($jsFile, 'console');
  }
}
