<?php

class HelloWorldPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = [
        'public_items_show', 
        'config_form'
    ];  


    public function hookPublicItemsShow($args)
    {
        echo '<h1> Hello World! This is an example of a plugin. </h1>'; 
        
    }

    public function hookConfigForm()
    {
      echo get_view()->partial('plugin/helloworld-config-form.php');
    }


    
    

   
}

