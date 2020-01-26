<?php

use TestSearchLib\src\App;
use TestSearchLib\src\Exceptions\InvalidUrlException;
use TestSearchLib\src\Exceptions\MimeTypeException;
use TestSearchLib\src\Exceptions\NotFoundException;
use TestSearchLib\src\Exceptions\SizeLimitException;
use TestSearchLib\src\Exceptions\UndefinedSearchException;
use PHPUnit\Framework\TestCase;

class NaiveSearchInSiteTest extends TestCase
{
  /**
   * @throws UndefinedSearchException
   */
  public function testSearch()
  {
    $url = "http://test.dev-arven.ru";

    $searcher = App::builder('remote', 'naive');
    $result = $searcher->run($url, "Задача");
    $this->assertNotNull($result);
    $resultFalse = $searcher->run($url, 'Lord Sauron');
    $this->assertNull($resultFalse);
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testException()
  {
    $this->expectException(InvalidUrlException::class);
    $url = "htp/test.de.ru";
    $searcher = App::builder('remote', 'naive');
    $searcher->run($url, 'Тарифы');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testSizeLimitException()
  {
    $this->expectException(SizeLimitException::class);
    $url = "https://www.tokkoro.com/picsup/2634568-the-witcher-3-4k-download-latest-wallpaper-for-pc.jpg";
    $searcher = App::builder('remote', 'naive');
    $searcher->run($url, 'Тарифы');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testMimeTypeException()
  {
    $this->expectException(MimeTypeException::class);
    $url = "https://cdn.igromania.ru/mnt/articles/1/f/f/4/d/c/31032/preview/93d3d3473f8b7f52_1200xH.jpg";
    $searcher = App::builder('remote', 'naive');
    $searcher->run($url, 'Тарифы');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testNotFoundException()
  {
    $this->expectException(NotFoundException::class);
    $url = "https://cdn.igromania.ru/mnt/articles/1/f/f/4/d/c/312/preview/93d3d3473f8b7f52_1200xH.jpg";
    $searcher = App::builder('remote', 'naive');
    $searcher->run($url, 'Тарифы');
  }
}
