<?php

namespace Drupal\piyonakademi_kingfish\Controller;

use Drupal\piyonakademi_kingfish\Utility\DescriptionTemplateTrait;

/**
 * Controller routines for block example routes.
 */
class ChessKingfishController {
  use DescriptionTemplateTrait;

  /**
   * {@inheritdoc}
   */
  protected function getModuleName() {
    return 'piyonakademi_kingfish';
  }

}
