<?php

/**
 * @file
 * Include file related with entity for chesstools core module.
 */

/**
 * Implements hook_form_FORM_ID_alter
 */
function chesstools_form_file_entity_add_upload_alter(&$form, &$form_state, $form_id) {
}

/**
 * Implements hook_entity_presave
 */
function chesstools_entity_presave($entity, $entity_type) { // changed $type to $entity_type
  list ($id, $vid, $bundle) = entity_extract_ids($entity_type, $entity);

  if ($entity_type = 'file' && $bundle = 'pgn') {
    // Read content of PGN file
    $pgn = drupal_realpath($entity -> uri);
    $pgn_content = file_get_contents($pgn);
//    dpm($pgn_content, '$pgn_content in ' . __FUNCTION__);

    // Compute fields from PGN file content
    $fields = _chesstools_pgn_to_fields($pgn_content);

    // Attach fields to $entity
    foreach ($fields as $key => $value) {
      $entity -> $key = $value;
    }
//    dpm($entity, '$entity in' . __FUNCTION__);
  }
}

function _chesstools_pgn_to_fields($pgn_content) {

  // Tags in PGN file, excluding 'metadata', 'fen' and 'moves'
  // @todo metadata
  $pgn_tags = array('event', 'site', 'date', 'round', 'white', 'black', 'result',
                    'eco', 'timecontrol', 'termination', 'plycount');
  $fields = array();

  // Utilize chessParser
  $parser = new pgnParser();
//  dpm($parser, '$parser in ' . __FUNCTION__);
  $parser -> setPgnContent($pgn_content);
  $game = $parser -> getFirstGame();
//  dpm($game, 'game');

  // Collect pgn tags (excluding metadata / fen / moves) into $fields
  foreach ($pgn_tags as $pgn_tag) {
    if (!empty($game[$pgn_tag])) {
      $field = 'field_chesstools_' . $pgn_tag;
      $fields[$field][LANGUAGE_NONE][0]['value'] = $game[$pgn_tag];
    }
  }

  // @todo
  // Collect 'fen' and 'moves' tag into field_chesstools_move
  // [0] for 'fen' tag (Starting position in FEN)
  // Actual moves start from [1]
  $start_fen = array(
    'algebraic' => NULL,
    'comment' => NULL,
    'variations' => NULL,
    'from' => NULL,
    'to' => NULL,
    'fen' => $game['fen'],
  );

  // replace key 'm' with 'algebraic'
  foreach ($game['moves'] as &$move) {
//    dpm($move);
    $move['algebraic'] = $move['m'];
    unset($move['m']);
  }

  array_unshift($game['moves'], $start_fen);
//  dpm($game, 'after unshift');
  $fields['field_chesstools_move'][LANGUAGE_NONE] = $game['moves'];

  return $fields;
}