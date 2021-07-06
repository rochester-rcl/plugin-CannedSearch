<h2>Selection Form</h2>
<br />

<div class="field">
    <div class="two columns alpha">
        <label for="item-types"><?php echo __('Selection Based on Categories'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation">
            <?php echo __("Search using the specified categories"); ?>
        </p>
      <?php 
        $item_types = get_item_types();
        $element = new Zend_Form_Element_Multiselect("SelectForm");
        $element->setLabel("SelectForm");
        $element->setMultiOptions(
         $item_types,
        );
        $options=get_option('SelectForm'); 
        $vals=unserialize($options); 
        $element->setValue($vals); 
        // serialize the ids and values 
        echo $element;
        ?> 
    </div>
</div>