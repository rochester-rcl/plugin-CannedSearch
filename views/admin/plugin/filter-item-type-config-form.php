<h2>Filter By Item Types Configuration</h2>
<br />

<div class="field">
    <div class="two columns alpha">
        <label for="item-types"><?php echo __('Select Item Types'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <p class="explanation">
            <?php echo __("Select item types to filter browse results by"); ?>
        </p>
      <?php 
        $item_types = get_item_types();
        $element = new Zend_Form_Element_Multiselect(FILTER_BY_ITEM_TYPES_OPTIONS_KEY);
        $element->setMultiOptions($item_types);
        $options = get_option(FILTER_BY_ITEM_TYPES_OPTIONS_KEY); 
        $vals = unserialize($options); 
        $element->setValue($vals); 
        echo $element;
        ?> 
    </div>
</div>