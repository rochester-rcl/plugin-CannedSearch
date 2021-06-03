<?php

class HelloWord_Form_Main extends Omeka_Form_Admin
{
    public function init()
    {
      parent::init();
      $this->_addItemTypeDropdown();
      $this->_addSubmit();
    }

    protected function _addItemTypeDropdown()
    {
      $db = get_db();
      $itemTypeTable = $db->ItemType;
      $sql = $db->query("SELECT DISTINCT id, name FROM `{$db->prefix}item_types`");
      $results = $sql->fetchAll();
      $itemTypes = array();
      foreach ($results as $result) {
        $itemTypes[$result['id']] = $result['name'];
      }
  
      // Add ability to select item type
      $this->addElement('select', 'item_type', array(
        'label' => 'Select Item Type to Apply the Viewer to.',
        'multiOptions' => $itemTypes,
      ));
    }

  protected function _addSubmit()
  {
    $this->addElement('submit', 'save', array('label' => 'Save'));
  }
  // I belive that this is similar to flaskform so that I added the _addSubmit which will have a submit button in my opinion

}