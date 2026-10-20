<?php

namespace eiriksm\KernelExistingTestTraits;

/**
 * Interface for tests that know where the existing site config lives.
 */
interface ExistingConfigAwareTestInterface {

  /**
   * Get the full path to the config dir.
   *
   * @return string
   *   The full path to the config dir.
   */
  public function getConfigDir() : string;

}
