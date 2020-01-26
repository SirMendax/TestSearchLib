<?php

use TestSearchLib\src\Exceptions\UndefinedSearchException;
use PHPUnit\Framework\TestCase;
use TestSearchLib\src\App;
use TestSearchLib\src\Modules\LocalModule;
use TestSearchLib\src\Modules\RemoteModule;

final class BuilderTest extends TestCase
{
  private ?array $modules = null;

  protected function setUp(): void
  {
    $this->modules = yaml_parse_file('src/config/modules.yaml');
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testBuilder(): void
  {
    $this->assertTrue(App::builder('local', 'hash') instanceof LocalModule);
    $this->assertTrue(App::builder('remote', 'naive') instanceof RemoteModule);
  }

  /**
   * @throws UndefinedSearchException
   */
  public function testException(): void
  {
    $this->expectException(UndefinedSearchException::class);
    App::builder('video', 'hash');
  }
}
