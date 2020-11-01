<?php


namespace ChristianFramework\Kernel;


use ChristianFramework\HttpModule\RunnableResponse;
use Exception;
use ChristianFramework\HttpModule\Exception\RouteNotFoundException;
use ChristianFramework\HttpModule\Request;
use ChristianFramework\HttpModule\Response;
use ChristianFramework\HttpModule\Router;
use ChristianFramework\Template\Template;

/**
 * Class Kernel
 * @package ChristianFramework\Kernel
 */
class Kernel
{
    private const ROUTES_PATH = __DIR__ . '/../../../../config/routes.php';
    /**
     * Request of kernel instance
     *
     * @var Request
     */
    protected Request $request;
    /**
     * Router created from request
     *
     * @var Router
     */
    protected Router $router;

    /**
     * Kernel constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->router = new Router($request);
        require_once(self::ROUTES_PATH);
        $this->router->setRoutes($routes);
    }

    /**
     * Handle request
     * @throws Exception
     */
    public function handle(): Response
    {
        try {
            return $this->router->handle();
        } catch (RouteNotFoundException $exception) {
            return new RunnableResponse("error_pages/404.php");
        }
    }
}