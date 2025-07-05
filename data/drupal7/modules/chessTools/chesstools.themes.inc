<?php

/**
 * @file
 * Include file related with theme functions for chesstools core module.
 */

/**
 * Implements hook_theme().
 */
function chesstools_theme($existing, $type, $theme, $path) {
  return array(
    'chesstools_board' => array(
      'variables' => array(
        'moves' => NULL,
      ),
    ),
  );
}

function theme_chesstools_board($variables) {
//  dpm($variables, '$variables in ' . __FUNCTION__);
  $moves = $variables['moves'];

  $output = '';
  $output .= '<div id="board" style="width: 400px"></div>';
  $output .= '<div class = "item-list"><ul class = "pager">';
  $output .= '<li><a class="first"><<</a></li>';
  $output .= '<li><a class="previous"><</a></li>';
  $output .= '<li><a class="next">></a></li>';
  $output .= '<li><a class="last">>></a></li>';
  $output .= '</ul></div>';
  $output .= '<ul class="moves">';
  foreach ( $moves as $key => $move ) {
    if ($key != 0 ) {
      $output .= '<li class="move"><span class="move-number">' . $key . '</span>';
      $output .= '<a class="algebraic" data-move-number="'. $key . '">' . check_plain($move['algebraic']) . '</a></li>';
    }
  }
  $output .= '</ul>';

  return $output;

}