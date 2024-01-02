<?php

namespace eiriksm\KernelExistingTestTraits;

interface ExistingConfigAwareTestInterface {

  /**
   * Get the full path to the config dir.
   *
   * @return string
   *   The full path to the config dir.
   */
  public function getConfigDir() : string;

}
