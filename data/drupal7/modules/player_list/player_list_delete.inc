<?php
/**
* @file
* Functions for deleting league player list.
*/

/**
* Option for deleting a player list.
*/
function league_player_delete_list_option($list) {
  $references = league_player_list_references($list->lid);
  if(count($references) == 0 ) {
    drupal_set_message("Deleting player list $list->lid ...");
    if(league_player_list_delete($list->lid) ) {
      drupal_set_message('List deleted');
    } else {
      drupal_set_message('List delete failed', 'error');
    }
    drupal_goto('node/' . $list->org . '/league/plists');
  } else {
    drupal_set_message("Cannot delete list because it is used by the following: " . implode(',', $references), 'error' );
    drupal_goto('league_player_list/' . $list->lid . '/admin');
  }
}
