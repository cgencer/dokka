<?php

namespace Drupal\piyonakademi_kingfish\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 * @Block(
 *   id = "example_configurable_text",
 *   admin_label = @Translation("Example: configurable text")
 * )
 */
class KingFishBoardBlock extends BlockBase {

  drupal_add_js(drupal_get_path('module', 'piyonakademi_kingfish') . '/mymodule.js');

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
//		'#theme' => 'chess_kingfish',
//		'#someVariable' => $some_variable,
		'#attached' => array(
			'library' => array(
				'piyonakademi_kingfish/KingFishBoardBlock',
			),
		),
    '#type' => 'markup',
    '#allowed_tags' => ['div', 'h3', 'p', 'br'],
    '#markup' => 
    '<div id="chessAIResults">' .
    '<h3>' . $this->t('Title of block'). '</h3>' .
    '<p id="container">' . 
    $this->t('This is a simple block!') . 
    '</p>' . 
    '</div>'
    ];
  }

}
