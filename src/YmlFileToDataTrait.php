<?php

namespace eiriksm\KernelExistingTestTraits;

use Symfony\Component\Yaml\Yaml;

trait YmlFileToDataTrait {

  public function getDataFromYmlFile($config_file) {
    if (!file_exists($config_file)) {
      throw new \Exception('Field config file ' . $config_file . ' does not exist.');
    }
    return Yaml::parseFile($config_file);
  }
}
