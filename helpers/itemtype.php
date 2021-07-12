
<?php

function get_item_types(){
  $db = get_db();
  $sql = $db->query("SELECT DISTINCT id, name FROM `{$db->prefix}item_types`");
  $results = $sql->fetchAll();
  $itemTypes = array();
  foreach($results as $result){
    $itemTypes[$result['id']] = $result['name'];
  }
  return $itemTypes;
}



