<?php

namespace eiriksm\KernelExistingTestTraits;

use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Symfony\Component\Yaml\Yaml;

/**
 * Trait relating to fields and field config.
 */
trait ExistingFieldTrait {

  /**
   * Create a field from existing config.
   */
  public function createFieldFromConfig(string $entity_type, string $bundle, string $field_name) {
    if (!$this instanceof ExistingConfigAwareTestInterface) {
      throw new \Exception('This trait can only be used by classes implementing ExistingConfigAwareTestInterface');
    }
    $config_dir = $this->getConfigDir();
    // Now get the file for this field. It should be named after entity type and
    // field name.
    $field_config_file = $config_dir . '/field.storage.' . $entity_type . '.' . $field_name . '.yml';
    if (!file_exists($field_config_file)) {
      throw new \Exception('Field config file ' . $field_config_file . ' does not exist.');
    }
    $data = Yaml::parseFile($field_config_file);
    $field_storage = FieldStorageConfig::create($data);
    $field_storage->save();
    // Then the field config.
    $field_config_file = $config_dir . '/field.field.' . $entity_type . '.' . $bundle . '.' . $field_name . '.yml';
    if (!file_exists($field_config_file)) {
      throw new \Exception('Field config file ' . $field_config_file . ' does not exist.');
    }
    $data = Yaml::parseFile($field_config_file);
    $field = FieldConfig::create($data);
    $field->save();
  }

}
