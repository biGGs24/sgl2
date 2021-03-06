<?php

class SGL2_Controller_Front
{
	public function bootstrap()
	{
		$b = new SGL2_Bootstrap();
		$methods = get_class_methods($b);
		foreach ($methods as $method) {
			$b->$method();
		}
		return $this;
	}

    public function dispatch()
    {
		$registry 	= SGL2_Registry::getInstance();
		$request 	= $registry->getRequest();
		$response 	= $registry->getResponse();
		$router 	= $registry->getRouter();

		$ret = false;
		try {
			$aRet = $router->route($request->getUri());
			$ret = $this->processRequest($registry, $request, $response);
		} catch (Exception $e) {
			throw $e;
		}
		return $ret;
	}

	public function processRequest(SGL2_Registry $registry, SGL2_Request $request,
		SGL2_Response $response)
	{
		$appController = new SGL2_Controller_Application($registry);
		$appController->handleRequest($request, $response);
		$ret = $appController->handleResponse($request, $response);
		return $ret;
	}		
}
?>