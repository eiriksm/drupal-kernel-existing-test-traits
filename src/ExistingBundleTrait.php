<?php

namespace eiriksm\KernelExistingTestTraits;

trait ExistingBundleTrait {
  use RequireConfigAwareTrait;
  use YmlFileToDataTrait;

  /**
   * Create a bundle from projects config.
   */
  public function createBundleFromConfig(string $entity_type, string $bundle) {
    $this->requireConfigAwareImplementation();
    // Get the YML file based on the config dir and the entity type and bundle.
    $config_dir = $this->getConfigDir();
    $bundle_config_file = $config_dir . "/$entity_type.type.$bundle.yml";
    $data = $this->getDataFromYmlFile($bundle_config_file);
    // Find the bundle entity type.
    $entity_type_manager = \Drupal::entityTypeManager();
    $entity_definition = $entity_type_manager->getDefinition('node');
    $bundle_entity_type = $entity_definition->getBundleEntityType();
    $storage = $entity_type_manager->getStorage($bundle_entity_type);
    $storage->create($data)->save();
  }

}
