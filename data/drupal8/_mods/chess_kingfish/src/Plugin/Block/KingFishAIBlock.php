<?php

namespace Drupal\chess_kingfish\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 * @Block(
 *   id = "chess_kingfish_ai_block",
 *   admin_label = @Translation("piyonAkademi ChessAI block")
 * )
 */
class KingFishAIBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'markup',
      '#allowed_tags' => ['div', 'h3', 'p', 'br'],
      '#markup' => '<div id="chessAIResults">' .
        '<h3>' . $this->t('Title of block'). '</h3>' .
        '<p id="container">' . 
          $this->t('This is a simple block!') . 
        '</p>' . 
        '</div>'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    return \Drupal\Core\Access\AccessResult::allowedIf($account->isAuthenticated());
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    // If you want to disable caching for this block.
    return 0;
  }
}
