<?php
/**
 * @file
 * Player List controller
 */

class PlayerListController extends DrupalDefaultEntityController {
  public function create($org) {
    return (object) array(
      'lid' => '',
      'org' => $org,
      'name' => '',
      'players' => array(),
    );
  }

  private function load_players($lid) {
    $rows = array();
    $query = db_select('player_list_player', 'lpp');
    $n_alias = $query->innerJoin('player_list_player', 'p', 'lpp.pid = p.pid');
    $query->condition('lpp.lid', $lid);
    $query->fields('p', array('pid', 'dob', 'sex', 'firstname', 'lastname'));
    // Add any other fields into the list, from other modules or UI
    $fields = field_info_instances('player_list', 'player_list');
    $keys=array();
    $f=0;
    foreach( $fields as $key => $field ) {
      $f++;
      $label = $field['label'];
      // Add field to the header and create a list of them
      $header[] = array('data' => $label, 'field' => $key);
      $keys[] = $key;
      // Add field to the query
      $table = 'field_data_' . $key;
      $abbrev = 'f' . $f;
      $query->leftJoin($table, $abbrev, 'p.pid = ' . $abbrev. '.entity_id');
      $query->addField($abbrev, $key . '_value', $key);
    }
    //print out query
    //dsm((string)$query);
    $result = $query->execute();
    // Transfer from object $row to array rows
    foreach ( $result as $row) {
      if(isset($row->dob)) {
        $row->dob = date('Y-m-d',$row->dob);
      }
      $rows[] = (array)$row;
    }
    return $rows;
  }

  public function save($list) {
    $transaction = db_transaction();

    try {
      if(strlen($list->name) > 20) {
        $list->name = substr($list->name, 0, 20);
      }
      $list->is_new = empty($list->lid);
      if($list->is_new) {
        drupal_write_record('player_list', $list);
        $op = 'insert';
      } else {
        drupal_write_record('player_list', $list, 'lid');
        $op = 'update';
      }
      // Save fields
      $function = 'field_attach_' . $op;
      $function('player_list', $list);

      module_invoke_all('entity_' . $op, $list, 'player_list');
      unset($list->is_new);

      db_ignore_slave();

      return $list;
    }
    catch (Exception $e) {
      $transaction->rollback();
      watchdog_exception('player_list', $e, NULL, WATCHDOG_ERROR);
      return FALSE;
    }
  }

  public function delete($lids) {
    if(!empty($lids)) {
      $lists = $this->load($lids, array());
      $transaction = db_transaction();

      try {
        // Remove all players from the lists
        db_delete('player_list_pids')
          ->condition('lid', $lids, 'IN')
          ->execute();
        // Remove the lists
        db_delete('player_list')
          ->condition('lid', $lids, 'IN')
          ->execute();

        foreach($lists as $lid => $list) {
          field_attach_delete('league_player_list', $list);
        }

        db_ignore_slave();
      }
      catch (Exception $e) {
        $transaction->rollback();
        watchdog_exception('player_list', $e, NULL, WATCHDOG_ERROR);
        return FALSE;
      }

      module_invoke_all('entity_delete', $list, 'player_list');

      cache_clear_all();
      $this->resetCache();
    }

    return TRUE;
  }

}

