<?php

namespace eiriksm\KernelExistingTestTraits;

/**
 * Trait for ensuring the using class implements the config aware interface.
 */
trait RequireConfigAwareTrait {

  /**
   * Helper to make sure the class using this trait implements the interface.
   */
  public function requireConfigAwareImplementation(): void {
    if (!$this instanceof ExistingConfigAwareTestInterface) {
      throw new \Exception('This trait can only be used by classes implementing ExistingConfigAwareTestInterface');
    }
  }

}
