<?php

class SGL2_Controller_App
{
	protected
	  $ctx	     	= null,
	  $dispatcher   = null;	
	
	public function __construct(SGL2_Context $ctx)
	{
		$this->ctx = $ctx;
		$this->dispatcher = $ctx->getEventDispatcher();
	}	
	
	public function handleRequest(SGL2_Request $request, SGL2_Response $response)
	{
		try {
			$controller = $this->resolveController($this->ctx, $request);
			$cmd = $controller->resolveCommand($this->ctx, $request); // while
			if ($cmd->validate($request)) {
				$cmd->execute($request, $response);			
			} else {
				//	handle validation fail
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	public function handleResponse(SGL2_Context $appCtx, SGL2_Request $request, SGL2_Response $response)
	{
		$view = $this->getView($appCtx, $request, $response);
//		$template = $view->getTemplate($requestCtx, $responseCtx);
		$ret = $this->invokeView($view);
		return $ret;
//		$this->dispatch($appCtx, $requestCtx, $responseCtx);
	}	
	
	public function getView(SGL2_Context $appCtx, SGL2_Request $request, SGL2_Response $response)
	{
		$config = $appCtx->getConfig();
		$response->layout = $config->modules->default->layout;
		$response->template = $config->modules->default->template;
		$response->theme = $config->site->defaultTheme;
        $view = new SGL2_View_Text($response);		
//        $view = new SGL2_View_Html($response);		
		return $view;
	}

	public function invokeView(SGL2_View_Abstract $view)
	{
		return $view->render();
	}		
	
	public function dispatch(SGL2_Context $appCtx, SGL2_Request $request, SGL2_Response $response)
	{
		try {
			$dispatcher = $appCtx->getRequestDispatcher($template);
			$dispatcher->forward($request, $response);
		} catch (Exception $e) {
			throw $e;
		}
	}	
	
	public function resolveController(SGL2_Context $appCtx, SGL2_Request $request)
	{
        $moduleName = $request->getModuleName();
        $controllerName = $request->getControllerName();
        $controller = $this->loadController($appCtx, $moduleName, $controllerName);		
		return $controller;
	}		
	
	public function loadController(SGL2_Context $appCtx, $moduleName, $controllerName)
	{
		if (is_null($controllerName)) {
			//	we only loading Commands, use this Controller
			$ret = $this;
			
		} else {
	        $file = "/modules/".ucfirst($moduleName)."/" .ucfirst($controllerName).'.php';
	        require PROJECT_PATH . $file;
	        $class = ucfirst($moduleName) .'_Controller_'. ucfirst($controllerName);
	        $ret = new $class($appCtx);
		}
        return $ret;				
	}				
	
	//	commands should not know about views	
	public function resolveCommand(SGL2_Context $appCtx, SGL2_Request $request)
	{
        $moduleName = $request->getModuleName();
        $controllerName = $request->getControllerName();
        $cmdName = $request->getCmdName();
        $oCmd = $this->loadCommand($appCtx, $moduleName, $controllerName, $cmdName);
        return $oCmd;		
	}
	
    public function loadCommand(SGL2_Context $appCtx, $moduleName, $controllerName, $cmdName)
    {
        $file = "/modules/$moduleName/Command/" .ucfirst($cmdName).'.php';
        require PROJECT_PATH . $file;
        $class = ucfirst($moduleName) .'_Command_'. ucfirst($cmdName);
        $obj = new $class($appCtx);
        return $obj;
    }
}

?>