<?php
/**
* @file
* Functions for viewing league player list.
*/

/**
*  $list   - list object
*  $node   - id of node that owns the list
*
*/
function league_player_list_view_page($list, $node=0, $link = 'league_player/', $view_mode = 'full') {

  if(!is_object($list)) {
    $content = array(
      '#markup' => '<h3>ERROR: No list found</h3>',
      '#type'   => 'markup',
    );
    return $content;
  }
  // Check access
  if(is_object($node)) {
    $level = league_org_value($list->org, 'lists');
    // Level > 1 means club owners can delete
    if($node->type == 'club') {
      if($level > 1 ) {
        $access = league_check_access($node->nid);
      } else {
        $access = league_check_access($list->org);
      }
    } else {
      $access = league_player_list_can_update($node);
    }
  } else {
    $access = league_check_access($list->org);
  }

  // Store URL for somewhere to get back to after a player is selected
  $list_link = $_GET['q'];
  $_SESSION['league_player_list_url'] = $list_link;
  if( array_key_exists('sort', $_GET) ) {
    $_SESSION['league_player_list_sort'] = $_GET['sort'];
  }
  if( array_key_exists('order', $_GET) ) {
    $_SESSION['league_player_list_order'] = $_GET['order'];
  }
  $_SESSION['league_player_list_page'] = pager_find_page();
  // Set bread crumb
  league_player_list_set_bread_crumb($list, $list_link, $node);

  $lid = $list->lid;

  $list->content = array();

  $name = $list->name;

  $list->content['players']['#table'] = league_player_get_org_players($lid, 'list', NULL, $link, $access);
  $list->content['players']['#theme'] = 'league_table';

  // Links on the bottom for subsequent pages
  $list->content['pager']['#markup'] = theme('pager');

  return $list->content;
}
 
/**
*  View player list tab off club
*/
function league_player_club_list_view($node, $org, $pid=0) {
  // Set Breadcrumb
  league_set_bread_crumb($node, $org);
  // Set title
  drupal_set_title($node->title);
  // If there is a player passed in then go directly there instead of the list
  if($pid != 0) {
    $player = league_player_load($pid);
    // If user had accces, go to edit the player
    if(league_check_access($org) ) {
      require_once 'league_player_update.inc';
      return league_player_edit_page($player);
    // otherwise go to view.
    } else {
      require_once 'league_player_view.inc';
      return league_player_view_page($player);
    }
  }
  // Get player list
  $lid = league_player_object_list($node->nid,$org);
  $list = league_player_list_load($lid);
  return league_player_list_view_page($list, $node);
}

/**
*  View player list tab off event
*/
function league_player_event_list_view($node) {
  // Set Breadcrumb
  league_set_bread_crumb($node);
  // Get player list
  $lid = league_player_event_value($node->nid, 'list');
  $list = league_player_list_load($lid);
  // View the player list
  return league_player_list_view_page($list, $node);
}

/**
*  View player list tab off fixture
*/
function league_player_fixture_list_view($node,$team,$pid=0) {
  // Set title
  $title =  league_fixture_title($node);
  drupal_set_title($title);

  if($pid != 0) {
    $player = league_player_load($pid);
    $org = league_fixture_value($node->nid, 'org');
    if(league_check_access($org) ) {
      require_once 'league_player_update.inc';
      return league_player_edit_page($player);
    } else {
      require_once 'league_player_view.inc';
      return league_player_view_page($player);
    }
  }
  // Get player list
  $teamNid = league_fixture_value($node->nid, $team.'Team');
  $lid = league_player_team_value($teamNid, 'list');
  $list = league_player_list_load($lid);
  if($team == 'home' ) {
    $teamLink = 'hlist';
  } else {
    $teamLink = 'alist';
  }
  return league_player_list_view_page($list, $node);
}

/**
*  View player list tab off fixture for individual event
*/
function league_player_fixture_elist_view($node) {
  // Get player list
  $event = league_fixture_value($node->nid, 'event');
  $lid = league_player_event_value($event, 'list');
  $list = league_player_list_load($lid);
  return league_player_list_view_page($list, $node);
}
