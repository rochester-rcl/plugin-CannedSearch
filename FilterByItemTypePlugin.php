<?php
require_once dirname(__FILE__) . '/helpers/itemtype.php';
define("FILTER_BY_ITEM_TYPES_OPTIONS_KEY", "filteritemtypes");

class FilterByItemTypePlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = [
        "config_form", 
        "config"
    ];

    protected $_filters = [
        "public_navigation_items"
    ];

    public function hookConfigForm()
    {
      echo get_view()->partial("plugin/filter-item-type-config-form.php");
    }

    public function hookConfig($args)
    {
        $selectedValues = $args["post"][FILTER_BY_ITEM_TYPES_OPTIONS_KEY];
        $serialized_value= serialize($selectedValues); 
        set_option(FILTER_BY_ITEM_TYPES_OPTIONS_KEY, $serialized_value); 

    }

    private function getCurrentParamString($exclude = [])
    {
       return array_filter($_GET, function ($key) use($exclude) {
            return !in_array($key, $exclude);
       }, ARRAY_FILTER_USE_KEY);
    }

    public function filterPublicNavigationItems($navArray)
    {
        $stored_ids = get_option(FILTER_BY_ITEM_TYPES_OPTIONS_KEY);
        $deserialized_ids = array_map(function ($id) { return (int) $id; }, unserialize($stored_ids));
        $all_item_types = get_item_types();
        $filtered_item_types = array_filter($all_item_types, function ($key) use($deserialized_ids) {
            return in_array($key, $deserialized_ids);
        }, ARRAY_FILTER_USE_KEY);
        $params = $this->getCurrentParamString(["type"]);
        $navRoutes = array_map(function ($item_type_id, $item_type) use($params) {
            return [
                "label" => __("Filter by {$item_type}"), 
                "uri" => url("items/browse", array_merge($params, ["type" => $item_type]))
            ];
        }, array_keys($filtered_item_types), $filtered_item_types);

        return array_merge($navArray, $navRoutes);
    }
}

