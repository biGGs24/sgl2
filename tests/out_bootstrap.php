<?php // this is an autogenerated file - do not edit (created 2010-03-18 16:46:56)
spl_autoload_register(
   function($class) {
      static $classes = array(
         'sgl2_array' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Array.php',
         'sgl2_bootstrap_abstract' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Bootstrap/Abstract.php',
         'sgl2_bootstrap' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Bootstrap.php',
         'sgl2_command_abstract' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Command/Abstract.php',
         'sgl2_context' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Context.php',
         'sgl2_controller_application' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Controller/Application.php',
         'sgl2_controller_front' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Controller/Front.php',
         'sgl2_exception' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Exception.php',
         'sgl2_locale' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Locale.php',
         'sgl2_registry' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Registry.php',
         'sgl2_request' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Request.php',
         'sgl2_response' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Response.php',
         'sgl2_router_adapter_horde' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Router/Adapter/Horde.php',
         'sgl2_router_adapter' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Router/Adapter.php',
         'sgl2_router_exception' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Router/Exception.php',
         'sgl2_router' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/Router.php',
         'sgl2_view_abstract' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/View/Abstract.php',
         'sgl2_view_html' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/View/Html.php',
         'sgl2_view_renderer_abstract' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/View/Renderer/Abstract.php',
         'sgl2_view_renderer_default' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/View/Renderer/Default.php',
         'sgl2_view_renderer_html_flexy' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/View/Renderer/Html/Flexy.php',
         'sgl2_view_text' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/SGL2/View/Text.php',
         'spldoublylinkedlist' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/bc/splqueue/spldoublylinkedlist.php',
         'splqueue' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/bc/splqueue/splqueue.php',
         'uber_component_exception' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Component/Exception.php',
         'uber_event_dispatcher' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Event/Dispatcher.php',
         'uber_event_interface' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Event/Interface.php',
         'uber_event_listener_collection' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Event/Listener/Collection.php',
         'uber_event_listener_interface' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Event/Listener/Interface.php',
         'uber_event' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Event.php',
         'uber_exception' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Exception.php',
         'uber_lazy_mixin_exception' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Lazy/Mixin/Exception.php',
         'uber_lazy_mixin' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Lazy/Mixin.php',
         'uber_lazy' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Lazy.php',
         'uber_loader_exception' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Loader/Exception.php',
         'uber_loader' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Loader.php',
         'uber_object_exception' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Object/Exception.php',
         'uber_object' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber/Object.php',
         'uber' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Uber.php',
         'zend_config_exception' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config/Exception.php',
         'zend_config_ini' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config/Ini.php',
         'zend_config_writer_array' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config/Writer/Array.php',
         'zend_config_writer_fileabstract' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config/Writer/FileAbstract.php',
         'zend_config_writer_ini' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config/Writer/Ini.php',
         'zend_config_writer_xml' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config/Writer/Xml.php',
         'zend_config_writer' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config/Writer.php',
         'zend_config_xml' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config/Xml.php',
         'zend_config' => '/Users/demian/Sites/sgl2_stuff/sgl2/src/lib/Zend/Config.php'
      );
      $cn = strtolower($class);
      if (isset($classes[$cn])) {
         require $classes[$cn];
      }
   }
);
?>
