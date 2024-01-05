<?php

namespace eiriksm\KernelExistingTestTraits;

use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Trait relating to fields and field config.
 */
trait ExistingFieldTrait {
  use RequireConfigAwareTrait;
  use YmlFileToDataTrait;

  /**
   * Create a field from existing config.
   */
  public function createFieldConfigWithStorage(string $entity_type, string $bundle, string $field_name) {
    $this->requireConfigAwareImplementation();
    $this->createFieldStorage($entity_type, $bundle, $field_name);
    // Then the field config.
    $this->createFieldConfig($entity_type, $bundle, $field_name);
  }

  /**
   * Just the field config.
   */
  public function createFieldConfig(string $entity_type, string $bundle, string $field_name) {
    $config_dir = $this->getConfigDir();
    $field_config_file = $config_dir . '/field.field.' . $entity_type . '.' . $bundle . '.' . $field_name . '.yml';
    $data = $this->getDataFromYmlFile($field_config_file);
    $field = FieldConfig::create($data);
    $field->save();
  }

  /**
   * Create a field storage from existing config.
   */
  public function createFieldStorage(string $entity_type, string $bundle, string $field_name) {
    $config_dir = $this->getConfigDir();
    // Now get the file for this field. It should be named after entity type and
    // field name.
    $field_config_file = $config_dir . '/field.storage.' . $entity_type . '.' . $field_name . '.yml';
    $data = $this->getDataFromYmlFile($field_config_file);
    // The value for "allowed values" slightly differ when you create them
    // programatically like this.
    if (!empty($data["settings"]["allowed_values"])) {
      $new_allowed_values = [];
      foreach ($data["settings"]["allowed_values"] as $value) {
        $new_allowed_values[$value['value']] = $value['label'];
      }
      $data["settings"]["allowed_values"] = $new_allowed_values;
    }
    $field_storage = FieldStorageConfig::create($data);
    $field_storage->save();
  }

}
