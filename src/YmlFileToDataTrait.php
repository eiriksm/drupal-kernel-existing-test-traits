<?php

namespace eiriksm\KernelExistingTestTraits;

use Symfony\Component\Yaml\Yaml;

/**
 * Trait for reading data from YML config files.
 */
trait YmlFileToDataTrait {

  /**
   * Get the parsed data from a YML config file.
   *
   * @param string $config_file
   *   The full path to the YML file.
   *
   * @return array<string, mixed>
   *   The parsed data.
   */
  public function getDataFromYmlFile(string $config_file): array {
    if (!file_exists($config_file)) {
      throw new \Exception('Field config file ' . $config_file . ' does not exist.');
    }
    return Yaml::parseFile($config_file);
  }

}
