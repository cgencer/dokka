<?php
/**
 * @file
 * League Player controller
 */

class PlayerListPlayerController extends DrupalDefaultEntityController {
  public function create($org) {
    return (object) array(
      'pid' => '',
      'org' => $org,
      'dob' => null,
      'sex' => '',
      'lastname' => '',
      'firstname' => '',
      'club' => 0,
      'uid' => 0,
    );
  }

  public function save($player) {
    $transaction = db_transaction();

    try {
      $player->is_new = empty($player->pid);
      if($player->is_new) {
        drupal_write_record('player_list_player', $player);
        $op = 'insert';
      } else {
        drupal_write_record('player_list_player', $player, 'pid');
        $op = 'update';
      }
      // Save fields
      $function = 'field_attach_' . $op;
      $function('player_list_player', $player);

      module_invoke_all('entity_' . $op, $player, 'player_list_player');
      unset($player->is_new);

      db_ignore_slave();

      return $player;
    }
    catch (Exception $e) {
      $transaction->rollback();
      watchdog_exception('player_list', $e, NULL, WATCHDOG_ERROR);
      return FALSE;
    }
  }

  public function delete($pids) {
    if(!empty($pids)) {
      $players = $this->load($pids, array());
      $transaction = db_transaction();

      try {
        db_delete('player_list_player')
          ->condition('pid', $pids, 'IN')
          ->execute();

// TODO - need this in rating list ? via hook entity_delete
//      db_delete('player_list_clubs')
//        ->condition('pid', $pids, 'IN')
//        ->execute();

        foreach($players as $pid => $player) {
          field_attach_delete('player_list_player', $player);
        }

        db_ignore_slave();
      }
      catch (Exception $e) {
        $transaction->rollback();
        watchdog_exception('player_list', $e, NULL, WATCHDOG_ERROR);
        return FALSE;
      }

      module_invoke_all('entity_delete', $player, 'player_list');

      cache_clear_all();
      $this->resetCache();
    }
    
    return TRUE;
  }
}

