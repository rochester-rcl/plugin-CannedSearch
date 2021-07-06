<?php
require_once dirname(__FILE__) . '/helpers/cannedsearchfunction.php';
class CannedSearchPlugin extends Omeka_Plugin_AbstractPlugin
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
        $tag_names = array_map(function ($t) { return $t->name;}, $tags);
        $links_html = implode(array_map(function($item_type_id) use($pair, $tag_names) {
            $query_params = array(
                "search" => "",
                "type" => $item_type_id,
                "tags" => implode(", ", $tag_names)
            );
            $href = url("items/browse", $query_params);
            return 
            "<div class=\"related-materials-link-container\">
                <h4><a class=\"related-materials-link\" href={$href}>Related {$pair[$item_type_id]}s</a></h4>
            </div>";
        }, $derserialize_ids));
        echo "<h2>Related Materials</h2>";
        echo "<div class=\"related-materials-container\">{$links_html}</div>";
    }

    public function hookConfigForm()
    {
      echo get_view()->partial('plugin/cannedsearch-config-form.php');
    }

    public function hookConfig($args)
    {
        $selectedValues = $args["post"]["SelectForm"];
        $serialized_value= serialize($selectedValues); 
        set_option('SelectForm', $serialized_value); 

    }
}

