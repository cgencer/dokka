<?php
/**
* @file
* Functions for league player options.
*/

/**
* Add new player to player list.
*/
function league_player_list_addp_page($list) {
  $org = $list->org;
  $player = entity_get_controller('league_player')->create($org);
  $club = league_chess_club_for_list($list);
  if($club!=0) {
    $player->club = $club;
  }
  $path = drupal_get_path('module', 'league_player');
  return drupal_get_form('league_player_update_form', $player, $list->lid);
}

/**
* Add existing player to player list.
*/
function league_player_list_adde_page($list,$nid=0) {
  $org = $list->org;
  $path = drupal_get_path('module', 'league_player');
  return drupal_get_form('league_player_add_to_list_form', $org, $list->lid, $nid);
}

function league_player_add_to_org($org) {

  $player = entity_get_controller('league_player')->create($org);
  return drupal_get_form('league_player_update_form', $player);
}
 
/**
*  Form for updating local player details.
*/
function league_player_update_form($form, &$form_state,$player,$lid=0) {

  $form['#league_player'] = $player;
  $form_state['league_player'] = $player;
  $form['#league_player_list'] = $lid;
  $form_state['league_player_list'] = $lid;

  $form['add'] = array(
   '#title' => t('Player details'),
   '#type'  => 'fieldset',
   '#attributes' => array(
                     'class' => array('update-player-fieldset'),
                    )
  );

  if(empty($player->pid)) {
    $btitle = 'Add';
  } else {
    $btitle = 'Update';
  }

  $form['buttons'] = array();
  $form['buttons']['#weight'] = 100;
  $form['buttons']['submit'] = array(
     '#value' => t($btitle),
     '#type'  => 'submit',
     '#weight' => 5,
  );
  if(!empty($player->pid)) {
    $form['buttons']['delete'] = array(
       '#value' => t('Delete'),
       '#type'  => 'submit',
       '#submit'  => array('league_player_update_delete'),
       '#weight' => 15,
    );
  }
  $form['buttons']['cancel'] = array(
    '#value' => t('Cancel'),
    '#type'  => 'submit',
    '#submit'  => array('league_player_update_cancel'),
    '#weight' => 25,
  );

  $form['add']['lastname'] = array(
   '#type'  => 'textfield',
   '#size'  => 20,
   '#title'  => t('Surname'),
   '#default_value'  => $player->lastname,
   '#weight' => 15,
  );

  $form['add']['firstname'] = array(
   '#type'  => 'textfield',
   '#size'  => 20,
   '#title'  => t('First name and initial'),
   '#default_value'  => $player->firstname,
   '#weight' => 20,
  );

  $clubs = league_clubs_in_org($player->org);
  $form['add']['club'] = array(
   '#type' => 'select',
   '#title'  => t('Club'),
   '#options' => $clubs,
   '#default_value'  => $player->club,
   '#weight' => 25,
  );

  $form['add']['dob'] = array(
   '#type'  => 'date_popup',
   '#title'  => t('Date Of Birth'),
   '#date_format'  => 'Y-m-d',
   '#date_label_position'  => 'within',
   '#date_year_range' => '-110:-2',
   '#weight' => 30,
  );
  if(isset($player->dob) ) {
    $form['add']['dob']['#default_value'] = date('Y-m-d',$player->dob);
  }

  $form['add']['sex'] = array(
   '#prefix' => '<div id=sex-select>',
   '#suffix' => '</div>',
   '#type'  => 'radios',
   '#title'  => t('Sex'),
   '#default_value'  => $player->sex,
   '#options'  => array( 'M' => 'Male', 'F' => 'Female' ),
   '#weight' => 35,
  );

  // Text Showing the User associated with the player
  $user_text = league_player_user_text($player->uid);
  $form['add']['user'] = array(
    '#markup' => '<div id="user-text">' . $user_text . '</div>',
    '#type'  => 'markup',
    '#weight' => 40,
  );

  // Hidden URL which button below will use.
  $url = 'league_player/ajax/looku/' . $player->pid;
  $form['add']['url'] = array(
    '#type' => 'hidden',
    // The name of the class is the #id of $form['ajax_button'] with "-url"
    // suffix.
    '#attributes' => array('class' => array('ctools-ajax-user-button-url')),
    '#value' => url($url),
  );

  // Button to popup selection list of users
  $form['add']['lookup'] = array(
    '#value' => t('Change User ID'),
    '#type'  => 'button',
    '#attributes' => array('class' => array('ctools-use-modal')),
    '#id' => 'ctools-ajax-user-button',
    '#weight' => 45,
    '#prefix' => '<div id="player-lookup-user">',
    '#suffix' => '</div>',
  );

  // Add in entity fields
  field_attach_form('league_player', $player, $form, $form_state);

  drupal_add_js(drupal_get_path('module', 'league_player').'/league_player.js');
  ctools_include('modal');
  ctools_modal_add_js();

  return $form;
}

function league_player_list_refresh_callback($form, $form_state) {
  $searchname = $form_state['values']['searchname'];
  $org = $form_state['league_player_org'];
  $lid = $form_state['league_player_list'];
  $nid = $form_state['league_player_nid'];

  $players = league_player_get_org_players($org, $type='org', $searchname, 'league_player/addto/'. $lid . '/', FALSE, $nid );
  $content = array(
    '#table' => $players,
    '#theme' => 'league_table',
  );
  $markup = drupal_render($content);
  $form['list']['ajax_markup']['#markup'] = $markup;
  return($form['list']['ajax_markup']);
}

/**
*  Action after the cancel button is pressed.
*/
function league_player_update_cancel($form, &$form_state) {
  $url = $_SESSION['league_player_list_url'];
  $page = $_SESSION['league_player_list_page'];
  if(isset($url)) {
    $options = array('query' => array('page' => $page));
    drupal_goto($url,$options);
  }
}

/**
*  Action after the delete button is pressed.
*/
function league_player_update_delete($form, &$form_state) {
  $player = $form_state['league_player'];
  // Make sure that the player is not in any lists.
  // (league_chess will check its not in any results)
  $references = league_player_lists_in($player->pid);
  if(count($references) == 0 ) {
    drupal_set_message("Deleting player $player->pid ...");
    if(league_player_delete($player->pid) ) {
      drupal_set_message('Player deleted');
    } else {
      drupal_set_message('Player delete failed', 'error');
    }
    drupal_goto('node/' . $player->org . '/league/players');
  } else {
    drupal_set_message("Cannot delete player because it is in the following lists: " . implode(',', $references), 'error' );
    drupal_goto('league_player/' . $player->pid . '/edit');
  }
}

/**
* Find references to the player in player lists
*/
function league_player_lists_in($pid) {
  $references = array();

  $query = db_select('league_player_player', 'lpp');
  $query->addField('lpp', 'lid', 'lid');
  $query->innerJoin('league_player_list', 'lpl', 'lpl.lid = lpp.lid');
  $query->addField('lpl', 'name', 'name');
  $query->condition('lpp.pid', $pid);

  $result = $query->execute();
  foreach ( $result as $row) {
    $references[] = l($row->name, 'league_player_list/' . $row->lid);
  }

  return $references;
}


/**
*  Action after the form is submitted.
*  Update local player record
*/
function league_player_update_form_submit($form, &$form_state) {
  $player = $form_state['league_player'];
  $player->lastname = ucfirst($form_state['values']['lastname']);
  $player->firstname = ucfirst($form_state['values']['firstname']);
  $player->sex = $form_state['values']['sex'];
  $player->club = $form_state['values']['club'];
  $dob = $form_state['values']['dob'];
  if(isset($dob)) {
//  $player->dob = strtotime($form_state['values']['dob']);
    $player->dob = league_date_to_time($form_state['values']['dob']);
  } else {
    $player->dob = null;
  }

  // Notify field widgets
  field_attach_submit('league_player', $player, $form, $form_state);

  // Save player
  league_player_save($player);

  drupal_set_message(t('Player Saved'));

  // Let other modules respond to a player update.
  module_invoke_all('league_player_player_update', $player);

  // Add player to list if there is one
  $lid = $form_state['league_player_list'];
  if($lid !=0) {
    $pid = $player->pid;
    league_player_add_to_list($pid, $lid);
    drupal_set_message(t("Player $pid Added to List $lid"));
  }
     
  $curr_uri = $_GET['q'];
  $listp = arg(3);
  if(arg(0) == 'node' && isset($listp) ) {
    $form_state['redirect'] = arg(0) . '/' . arg(1) . '/' . arg(2);
  } else  {
    if(arg(0) == 'league') {
      if(arg(1) == 'club') {
        $org = arg(3);
        $club = arg(2);
        $form_state['redirect'] = "league/club/$club/$org/plist";
      }
    } else {
      if($lid ==0) {
        $form_state['redirect'] = 'league_player/' . $player->pid;
      } else {
        $form_state['redirect'] = 'league_player_list/' . $lid;
      }
    }
  }
}

function league_player_add_to_list_page($lid, $pid, $nid=0) {
  if(league_player_in_list($pid, $lid)) {
    drupal_set_message(t("Could not add, player already in list"), 'error');
  } else {
    league_player_add_to_list($pid, $lid);
    drupal_set_message(t("Player added to list"));
  }
  if($nid == 0) {
    league_player_list_goto($lid);
  } else {
    $node = node_load($nid);
    if($node->type == 'club') {
      $list = league_player_list_load($lid);
      $org = $list->org;
      drupal_goto("league/club/$nid/$org/org/plist");
    } else {
      $url = $_SESSION['league_player_list_url'];
      if(isset($url) ) {
        $page = $_SESSION['league_player_list_page'];
        $options = array('query' => array('page' => $page));
        drupal_goto($url,$options);
      } else {
        drupal_goto("node/$nid/elist");
      }
    }
  }
}

function league_player_edit_page($player) {
  // Set breadcrumb
  league_player_set_bread_crumb($player);
  // Show form
  return drupal_get_form('league_player_update_form', $player);
}

function league_player_add_to_list_form($form, &$form_state,$org,$lid=0,$nid=0) {

  $form['#league_player_list'] = $lid;
  $form_state['league_player_list'] = $lid;
  $form_state['league_player_org'] = $org;
  $form_state['league_player_nid'] = $nid;

  $form['list'] = array(
   '#title' => t('Existing Player details'),
   '#type'  => 'fieldset',
   '#attributes' => array(
                     'class' => array('existing-player-fieldset'),
                    )
  );
  $form['list']['searchname'] = array(
   '#type'  => 'textfield',
   '#size'  => 20,
   '#title'  => t('Surname to search for'),
   '#weight' => 5,
  );

  $form['list']['search'] = array(
   '#value' => t('Search For Player'),
   '#type'  => 'button',
   '#weight' => 10,
   '#ajax' => array(
     'callback' => 'league_player_list_refresh_callback',
     'wrapper' => 'ajax_markup_div',
   ),
  );

  $markup = ' ';
  if(empty($form_state['values']['searchname'])) {
    // Pass in an org of -1 so we get an empty table the first time
    $players = league_player_get_org_players(-1, 'org', NULL, 'league_player/addto/'. $lid . '/' );
    $content = array(
      '#table' => $players,
      '#theme' => 'league_table',
    );
    $markup = drupal_render($content);
  }
  $form['list']['ajax_markup'] = array(
   '#prefix' => '<div id="ajax_markup_div">',
   '#suffix'  => '</div>',
   '#markup' => $markup,
   '#weight' => 15,
  );

  return $form;
}

function league_player_club_list_addp($node, $org) {
  // Set Breadcrumb
  league_set_bread_crumb($node);
  // Get player list and load it
  $lid = league_player_object_list($node->nid,$org);
  $list = league_player_list_load($lid);
  // display form to add existing
  return league_player_list_addp_page($list);
}

function league_player_club_list_adde($node, $org) {
  // Set Breadcrumb
  league_set_bread_crumb($node);
  // Set title
  drupal_set_title($node->title);
  // Get player list and load it
  $lid = league_player_object_list($node->nid,$org);
  $list = league_player_list_load($lid);
  // display form to add existing
  return league_player_list_adde_page($list, $node->nid);
}

function league_player_event_list_addp($node) {
  // Set Breadcrumb
  league_set_bread_crumb($node);
  // Get player list and load it
  $lid = league_player_event_value($node->nid, 'list');
  $list = league_player_list_load($lid);
  // display form to add existing
  return league_player_list_addp_page($list);
}

function league_player_event_list_adde($node) {
  // Set Breadcrumb
  league_set_bread_crumb($node);
  // Get player list and load it
  $lid = league_player_event_value($node->nid, 'list');
  $list = league_player_list_load($lid);
  // display form to add existing
  return league_player_list_adde_page($list, $node->nid);
}

function league_player_fixture_list_addp($node,$team) {
  // Set Breadcrumb
  league_set_bread_crumb($node);
  // Get player list and load it
  if( $team=='event' ) {
    $event = league_fixture_value($node, 'event');
    $lid = league_player_event_value($event, 'list');
  } else {
    $teamNid = league_fixture_value($node->nid, $team.'Team');
    $lid = league_player_team_value($teamNid, 'list');
  }
  $list = league_player_list_load($lid);
  // display form to add existing
  return league_player_list_addp_page($list);
}

function league_player_fixture_list_adde($node,$team) {
  // Set Breadcrumb
  league_set_bread_crumb($node);
  // Get player list and load it
  if( $team=='event' ) {
    $event = league_fixture_value($node, 'event');
    $lid = league_player_event_value($event, 'list');
  } else {
    $teamNid = league_fixture_value($node->nid, $team.'Team');
    $lid = league_player_team_value($teamNid, 'list');
  }
  $list = league_player_list_load($lid);
  // display form to add existing
  return league_player_list_adde_page($list, $node->nid);
}
