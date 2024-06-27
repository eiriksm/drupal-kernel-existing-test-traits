<?php

namespace eiriksm\KernelExistingTestTraits;

use Drupal\Core\Entity\Entity\EntityViewDisplay;

trait ExistingBundleTrait {
  use RequireConfigAwareTrait;
  use YmlFileToDataTrait;

  /**
   * Create a bundle from projects config.
   */
  public function createBundleFromConfig(string $entity_type, string $bundle) {
    $this->requireConfigAwareImplementation();
    // Find the bundle entity type.
    $entity_type_manager = \Drupal::entityTypeManager();
    $entity_definition = $entity_type_manager->getDefinition($entity_type);
    // Get the YML file based on the config dir and the entity type and bundle.
    $config_dir = $this->getConfigDir();
    $bundle_config_file = $config_dir . "/$entity_type.type.$bundle.yml";
    if ($entity_type === 'taxonomy_term') {
      // This is a specific case where we know the bundle file will look like
      // this.
      $bundle_config_file = $config_dir . "/taxonomy.vocabulary.$bundle.yml";
    }
    $data = $this->getDataFromYmlFile($bundle_config_file);
    $bundle_entity_type = $entity_definition->getBundleEntityType();
    $storage = $entity_type_manager->getStorage($bundle_entity_type);
    $storage->create($data)->save();
  }

  /**
   * Create the default display for a bundle.
   */
  public function createDefaultDisplay(string $entity_type, string $bundle) {
    $this->createDisplay($entity_type, $bundle, 'default');
  }

  /**
   * Create a display for a bundle.
   */
  public function createDisplay(string $entity_type, string $bundle, string $mode) {
    $display_config_file = $this->getConfigDir() . "/core.entity_view_display.$entity_type.$bundle.$mode.yml";
    $data = $this->getDataFromYmlFile($display_config_file);
    EntityViewDisplay::create($data)->save();
  }

}
