<?php

namespace eiriksm\KernelExistingTestTraits\Tests\Fixtures;

use eiriksm\KernelExistingTestTraits\ExistingBundleTrait;
use eiriksm\KernelExistingTestTraits\ExistingConfigAwareTestInterface;
use eiriksm\KernelExistingTestTraits\ExistingFieldTrait;

/**
 * Class using all the traits, so static analysis covers them.
 */
class TraitConsumer implements ExistingConfigAwareTestInterface {

  use ExistingBundleTrait;
  use ExistingFieldTrait;

  /**
   * {@inheritdoc}
   */
  public function getConfigDir() : string {
    return __DIR__;
  }

}
