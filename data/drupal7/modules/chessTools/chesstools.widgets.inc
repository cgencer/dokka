<?php

/**
 * @file
 * Include file related with field widgets for chesstools core module.
 */

/**
 * Implements hook_field_widget_info().
 */
function chesstools_field_widget_info() {
  return array(
    'chesstools_autofill_fen' => array(
      'label' => t('Autofill from pgn'),
      'field types' => array('chesstools_move'),
    ),
  );
}

/**
 * Implements hook_field_widget_form().
 */
function chesstools_field_widget_form(&$form, &$form_state, $field, $instance, $langcode, $items, $delta, $element) {
  $value = 'rnbqkbnr\/pppppppp\/8\/8\/8\/8\/PPPPPPPP\/RNBQKBNR w KQkq - 0 1'.$delta;
//  dpm($form, '$form in ' . __FUNCTION__);
//  dpm($form_state, '$form_state in ' . __FUNCTION__);
//  $widget['#delta'] = $delta;


//  if (empty($items)) $items[0]['value'] = NULL;
  switch ($instance['widget']['type']) {
    case 'chesstools_autofill_fen':
      $widget = $element + array(
        '#title' => 'title',
        '#type' => 'textfield', // todo
        '#size' => FEN_LENGTH_MAX,
        '#default_value' => isset($items[$delta]['value']) ? $items[$delta]['value'] : NULL,
      );
      break;
  }

  $element['value'] = $widget;
//  dpm($element, '$element in ' . __FUNCTION__);
  return $element;
}

/**
 * Implements hook_field_widget_error().
 *
 * hook_field_widget_error() lets us figure out what to do with errors
 * we might have generated in hook_field_validate(). Generally, we'll just
 * call form_error().
 *
 * @see chesstools_field_validate()
 * @see form_error()
 */
function chesstools_field_widget_error($element, $error, $form, &$form_state) {
  switch ($error['error']) {
    case 'chesstools_invalid':
      form_error($element, $error['message']);
      break;
  }
}