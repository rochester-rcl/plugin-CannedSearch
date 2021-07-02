
<?php

class CannedSearch_Form_Main extends Omeka_Form_Admin
{
    public function init()
    {
      parent::init();
      $this->_addItemTypeDropdown();
      $this->_addSubmit();
      $this ->_selectForm(); 
      $this->_selectForm1(); 
    }

  protected function _addSubmit()
  {
    $this->addElement('submit', 'save', array('label' => 'Save'));
  }

}