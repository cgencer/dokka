<?php
/**
* @file
* Functions for player list update.
*/

function player_list_add_to_org($org) {

  $list = entity_get_controller('player_list')->create($org);
  drupal_set_title('Add player List');
  return drupal_get_form('player_list_update_form', $list);
}
 
/**
*  Form for updating local player details.
*/
function player_list_update_form($form, &$form_state,$list) {

  $form['#player_list'] = $list;
  $form_state['player_list'] = $list;

  if(empty($list->lid)) {
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
  if(!empty($list->lid)) {
    $form['buttons']['delete'] = array(
       '#value' => t('Delete'),
       '#type'  => 'submit',
       '#submit'  => array('player_list_update_form_delete'),
       '#weight' => 15,
    );
  }

  $form['name'] = array(
   '#type'  => 'textfield',
   '#size'  => 20,
   '#maxlength'  => 20,
   '#title'  => t('List Name'),
   '#default_value'  => $list->name,
   '#required'  => TRUE,
   '#weight' => 15,
  );

  field_attach_form('player_list', $list, $form, $form_state);

  return $form;
}

/**
*  Action after the form is submitted.
*/
function player_list_update_form_submit($form, &$form_state) {
  $list = $form_state['player_list'];
  $list->name = $form_state['values']['name'];

  // Notify field widgets
  field_attach_submit('player_list', $list, $form, $form_state);

  // Save player list
  player_list_save($list);

  drupal_set_message(t('Player List Saved'));
     
  $form_state['redirect'] = 'player_list/' . $list->lid;
}

/**
*  Action after the delete button is pressed.
*/
function player_list_update_form_delete($form, &$form_state) {
  $list = $form_state['player_list'];
  $destination = array();
  if(isset($_GET['destination']) ) {
    $destination = drupal_get_destination();
    unset($_GET['destination']);
  }
  $form_state['redirect'] = array('player_list/' . $list->lid . '/delete',
                              array( 'query' => $destination));
}

function player_list_edit_page($list) {
  // Set bread crumb
  player_list_set_bread_crumb($list,"player_list/$list->lid");
  return drupal_get_form('player_list_update_form', $list);
}
