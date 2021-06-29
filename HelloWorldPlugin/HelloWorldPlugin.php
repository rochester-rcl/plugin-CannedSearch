<?php
define('HELLO_WORLD_PLUGIN_DIR', dirname(__FILE__));
require_once dirname(__FILE__) . '/helpers/helloworldfunction.php';
class HelloWorldPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = [
        'public_items_show', 
        'config_form', 
        'config'
    ];  


    public function hookPublicItemsShow($args)
    { 
        $item = $args['item'];
        $tags = $item->getTags();
        $options=get_option('SelectForm'); 
        $derserialize_ids=unserialize($options); 
        $pair = get_item_types();
        
    echo '<h2> Selected Items: <h2> ';
    $links='';
     foreach ($derserialize_ids as $ids){
        $links=$links.'+'.$pair[$ids]; // --> concatenated the names of IDs for searching
    // echo  link_to_item_search($pair[$ids],$derserialize_ids, null ); 
    // the above line returns a hyperlink with names of the IDs selected but then it takes me to a new form again.
     echo url($pair[$ids], $derserialize_ids);// this renders a plain text
   
     echo '<br> ';
    }
    //echo url($options = $links); -->  this renders a plain text
}

    public function hookConfigForm()
    {
      echo get_view()->partial('plugin/helloworld-config-form.php');
    }

    public function hookConfig($args)
    {
        $selectedValues = $args["post"]["SelectForm"];
        $serialized_value= serialize($selectedValues); 
        set_option('SelectForm', $serialized_value); 

    }

    function link_to_item_search($text = null, $props = array(), $uri = null)
{
    if (!$text) {
        $text = __('Search Items');
    }
    if (!$uri) {
        $uri = apply_filters('items_search_default_url', url('items/search'));
    }
    $props['href'] = $uri . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
    return'<a ' . tag_attributes($props) . '>' . $text . '</a>';
}


    
    

   
}

