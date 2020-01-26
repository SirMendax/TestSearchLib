<?php

use TestSearchLib\src\App;
use TestSearchLib\src\Exceptions\InvalidUrlException;
use TestSearchLib\src\Exceptions\MimeTypeException;
use TestSearchLib\src\Exceptions\NotFoundException;
use TestSearchLib\src\Exceptions\SizeLimitException;
use TestSearchLib\src\Exceptions\UndefinedSearchException;
use PHPUnit\Framework\TestCase;

class HashSearchInSiteTest extends TestCase
{
  /**
   * @throws UndefinedSearchException
   */
  public function testSearch()
  {
    $url = "http://test.dev-arven.ru";

    $search = App::builder('remote', 'hash');
    $result = $search->run($url, 'Тарифы');
    $this->assertTrue($result['line'] !== null);

    $result = $search->run($url, 'kurwa');
    $this->assertNull($result);

    $result = $search->run($url, 'lorem');
    $this->assertNull($result);
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testException()
  {
    $this->expectException(InvalidUrlException::class);
    $url = "htp/test.de.ru";
    $search = App::builder('remote', 'hash');
    $search->run($url, 'Тарифы');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testSizeLimitException()
  {
    $this->expectException(SizeLimitException::class);
    $url = "https://www.tokkoro.com/picsup/2634568-the-witcher-3-4k-download-latest-wallpaper-for-pc.jpg";
    $search = App::builder('remote', 'hash');
    $search->run($url, 'Тарифы');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testMimeTypeException()
  {
    $this->expectException(MimeTypeException::class);
    $url = "https://cdn.igromania.ru/mnt/articles/1/f/f/4/d/c/31032/preview/93d3d3473f8b7f52_1200xH.jpg";
    $search = App::builder('remote', 'hash');
    $search->run($url, 'Тарифы');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testNotFoundException()
  {
    $this->expectException(NotFoundException::class);
    $url = "https://cdn.igromania.ru/mnt/articles/1/f/f/4/d/c/312/preview/93d3d3473f8b7f52_1200xH.jpg";
    $search = App::builder('remote', 'hash');
    $search->run($url, 'Тарифы');
  }
}
