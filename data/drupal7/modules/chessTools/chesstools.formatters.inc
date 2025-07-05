<?php

/**
 * @file
 * Include file related with field formatters for chesstools core module.
 */


/**
 * Implements hook_field_formatter_info().
 *
 * @see chesstools_field_formatter_view()
 */
function chesstools_field_formatter_info() {
  return array(
    'chesstools_board' => array(
      'label' => t('Chess board based on FEN'),
      'field types' => array('chesstools_move'),
      'description'   => t('Displays chess moves in a chess board.')
    ),
  );
}

/**
 * Implements hook_field_formatter_view().
 *
 * @see chesstools_field_formatter_info()
 */
function chesstools_field_formatter_view($entity_type, $entity, $field, $instance, $langcode, $items, $display) {
  $element = array();
//  dpm($items, '$items in ' . __FUNCTION__);
  switch ($display['type']) {
    // This formatter outputs chess moves as a chess board.
    case 'chesstools_board':
      $fid = $entity->fid;
      $data = array('chesstools' => array('board' => array($fid => $items)));
      $element = array(
        '#theme' => 'chesstools_board',
        '#moves' => $items,
        '#prefix' => '<div class="chesstools-board-wrapper" data-fid="' . $fid . '">',
        '#suffix' => '</div>',
        '#attached' => array(
          'js' => array(
            libraries_get_path('chess.js', true) . '/chess.min.js',
            '$=jQuery' => array( 'type' => 'inline' ),
            libraries_get_path('chessboard.js', true) . '/js/chessboard-0.3.0.min.js',
            drupal_get_path('module', 'chesstools') . '/js/chesstools-board.js',
            array('data' => $data, 'type' => 'setting'),
          ),
          'css' => array(
            libraries_get_path('chessboard.js') . '/css/chessboard-0.3.0.min.css',
            drupal_get_path('module', 'chesstools') . '/css/chesstools-board.css',
          )
        ),
      );
      break;

  }

  return $element;
}