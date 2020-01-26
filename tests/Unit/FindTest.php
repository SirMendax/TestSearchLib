<?php

use PHPUnit\Framework\TestCase;
use TestSearchLib\src\Algorithm\HashFind;
use TestSearchLib\src\Algorithm\NaiveFind;

final class FindTest extends TestCase
{
  public function testHashSum()
  {
    $this->assertEquals(65, HashFind::hashSum('A'));
    $this->assertEquals(131, HashFind::hashSum('AB'));
    $this->assertEquals(265, HashFind::hashSum('ABCC'));
    $this->assertEquals(299, HashFind::hashSum('AdCC'));
    $this->assertEquals(382, HashFind::hashSum('ADAy?'));
    $this->assertEquals(262, HashFind::hashSum('Adatdsg', 'str'));
  }

  public function testHash()
  {
    $res = HashFind::findInStr('ADbxcb1 sdg931', '31');
    $this->assertEquals(true, $res['status']);
    $this->assertEquals(12, $res['position']);

    $res = HashFind::findInStr('ADbxcb1 sdg931', 's8');
    $this->assertNull($res);

    $res = HashFind::findInStr('ADbxcb1 sdg931', 'S');
    $this->assertNull($res);

    $res = HashFind::find('ADbxcb1 sdg931', '31');
    $this->assertEquals(true, $res['status']);
    $this->assertEquals(12, $res['position']);

    $res = HashFind::find('ADbxcb1 sdg931', 's8');
    $this->assertNull($res);

    $res = HashFind::find('ADbxcb1 sdg931', 'S');
    $this->assertNull($res);

    $res = HashFind::find('S', 'S');
    $this->assertNotNull($res);
  }

  public function testNaive()
  {
    $res = NaiveFind::find('ADbxcb1 sdg931', 'sdg931');
    $this->assertEquals(true, $res['status']);
    $this->assertEquals(8, $res['position']);

    $res = NaiveFind::find('ADbxcb1 sdg931', 's8');
    $this->assertNull($res);

    $res = NaiveFind::find('ADbxcb1 sdg931', 'S');
    $this->assertNull($res);
  }
}
