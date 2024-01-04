<?php

namespace eiriksm\KernelExistingTestTraits;

trait RequireConfigAwareTrait {

  /**
   * Helper to make sure the class using this trait implements the interface.
   */
  public function requireConfigAwareImplementation() {
    if (!$this instanceof ExistingConfigAwareTestInterface) {
      throw new \Exception('This trait can only be used by classes implementing ExistingConfigAwareTestInterface');
    }
  }

}
