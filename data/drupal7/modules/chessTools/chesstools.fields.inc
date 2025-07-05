<?php

/**
 * @file
 * Include file related with fields for chesstools core module.
 */

/**
 * Implements hook_field_info().
 *
 * Define field type 'chesstools_move'
 */
function chesstools_field_info() {
  return array(
    // We name our field as the associative name of the array.
    'chesstools_move' => array(
      'label' => t('Chess move'),
      'description' => t('Describe a particular board position of each move in a chess game.'),
      'settings' => array(),
      'instance_settings' => array(),
      'default_widget' => 'chesstools_board',
      'default_formatter' => 'chesstools_board',
      'no_ui' => FALSE,
    ),
  );
}

/**
 * Implements hook_field_validate().
 */
function chesstools_field_validate($entity_type, $entity, $field, $instance, $langcode, $items, &$errors) {
//  foreach ($items as $delta => $item) {
//    if (!empty($item['fen'])) {
//      if (!preg_match('@^#[0-9a-f]{6}$@', $item['fen'])) {
//        $errors[$field['field_name']][$langcode][$delta][] = array(
//          'error' => 'chesstools_invalid',
//          'message' => t('Color must be in the HTML format #abcdef.'),
//        );
//      }
//    }
//  }
}


/**
 * Implements hook_field_is_empty().
 *
 * hook_field_is_emtpy() is where Drupal asks us if this field is empty.
 * Return TRUE if it does not contain data, FALSE if it does. This lets
 * the form API flag an error when required fields are empty.
 */
function chesstools_field_is_empty($item, $field) {
  return empty($item['fen']);
}



/**
 * Validate the individual fields and then convert to fen string.
 */
function chesstools_autofill_fen_validate($element, &$form_state) {
//  dpm($element, '$element when in validation');
  $delta = $element['#delta'];
  $field = $form_state['field'][$element['#field_name']][$element['#language']]['field'];
  $field_name = $field['field_name'];
  if (isset($form_state['values'][$field_name][$element['#language']][$delta]['value'])) {
    $value = $form_state['values'][$field_name][$element['#language']][$delta]['value'];
    form_set_value($element, $value, $form_state);
  }
}

/**
 * Implements hook_field_attach_presave().
 *
 * Computing for the autofill widget(s) is done here to ensure that only validated
 * and fully processed fields values are accessed.
 */
//function chesstools_field_attach_presave($entity_type, $entity) {
//  $entity_info = entity_get_info($entity_type);
//  $bundle_name = empty($entity_info['entity keys']['bundle']) ? $entity_type : $entity->{$entity_info['entity keys']['bundle']};
//  foreach (field_info_instances($entity_type, $bundle_name) as $field_instance) {
//    if ($field_instance['widget']['type'] === 'chesstools_autofill_fen') {
//      if (TRUE) {
//        dpm($entity, '$entity in ' . __FUNCTION__);
//        $entity->{$field_instance['field_name']} = array(LANGUAGE_NONE => array('value' => 'computed'));
//      }
//    }
//  }
//}