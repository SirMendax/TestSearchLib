<?php

namespace TestSearchLib\src;

use TestSearchLib\src\Exceptions\UndefinedSearchException;
use TestSearchLib\src\Interfaces\BuilderInterface;
use TestSearchLib\src\Interfaces\SearchInterface;

/**
 * Class App
 * The code is realisation of Static Factory pattern
 * @package TestSearchLib\src
 */
class App implements BuilderInterface
{
  /**
   * @param string $module
   * @param string $algorithm
   * @return SearchInterface
   * @throws UndefinedSearchException
   */
  public static function builder(string $module, string $algorithm) :SearchInterface
  {
    $modules = yaml_parse_file( __DIR__ . "/config/modules.yaml");
    $config = yaml_parse_file(__DIR__ . "/config/configuration.yaml");
    $algorithms = $modules['algorithm'];

    foreach($modules['searcher'] as $key => $classModule) {
      if($key === $module){
        foreach ($algorithms as $name => $classAlgorithm){
          if($name === $algorithm)
            //Dependency injection
            return new $classModule(new $modules['sanitizer']($config), new $classAlgorithm);
        }
      }
    }
    throw new UndefinedSearchException('Undefined type searcher');
  }
}
