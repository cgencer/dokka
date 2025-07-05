<?php
/**
* @file
* Functions for viewing league player list.
*/

function league_player_delete_from_list($pid, $lid, $page=0) {
  drupal_set_message("Deleting player $pid from list $lid ...");
  $nrecs = league_player_delete_player_from_list($pid, $lid);
  drupal_set_message("$nrecs records deleted");
  // Try to retain what page we were on and the sort if any.
  league_player_list_goto($lid, $page);
}

function league_player_delete_player_from_list($pid, $lid) {
  $nrecs = db_delete('league_player_player')
    ->condition('lid' , $lid)
    ->condition('pid' , $pid)
    ->execute();
  return $nrecs;
}

function league_player_delete_from_org($pid, $org) {
  drupal_set_message("Deleting player $pid from lists in org $org ...");
  $nrecs = league_player_delete_lists($pid, $org);
  drupal_set_message("$nrecs records deleted");
  drupal_set_message("Deleting player $pid ...");
  if( league_player_delete($pid) ) {
    drupal_set_message("Player deleted.");
  }
  drupal_goto('node/' . $org . '/league/players');
}

function league_player_delete_lists($pid, $org) {

  // Delete player from all lists.
  // No need to check org because $pid is unique
  // and a player from one org can't be in a list from another.
  $query = db_delete('league_player_player');
  $query->condition('pid' , $pid);
//dsm((string)$query);
  $nrecs = $query->execute();
  return $nrecs;
}
