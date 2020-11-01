<?php


namespace ChristianFramework\HttpModule;


use ChristianFramework\DataStructuresModule\ParamsBag;

class Request
{
    /**
     * Request body parameters ($_POST)
     *
     * @var ParamsBag
     */
    protected ParamsBag $requestParams;

    /**
     * Query string parameters ($_GET)
     *
     * @var ParamsBag
     */
    protected ParamsBag $queryParams;

    /**
     * Custom parameters
     *
     * @var ParamsBag
     */
    protected ParamsBag $attributes;

    /**
     * Server and execution environment parameters ($_SERVER)
     *
     * @var ServerBag
     */
    protected ServerBag $serverParams;

    /**
     * Uploaded files ($_FILES).
     *
     * @var ParamsBag
     */
    protected ParamsBag $filesParams;

    /**
     * Cookies ($_COOKIE).
     *
     * @var ParamsBag
     */
    protected ParamsBag $cookiesParams;

    /**
     * Headers (from $_SERVER)
     *
     * @var ParamsBag
     */
    protected ParamsBag $headers;

    /**
     * @var mixed|null
     */
    protected $content;

    /**
     * Request constructor.
     * @param array $query
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param mixed $content
     */
    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        $this->queryParams = new ParamsBag($query);
        $this->requestParams = new ParamsBag($request);
        $this->attributes = new ParamsBag($attributes);
        $this->cookiesParams = new ParamsBag($cookies);
        $this->filesParams = new ParamsBag($files);
        $this->serverParams = new ServerBag($server);
        $this->headers = new ParamsBag($this->serverParams->getHeaders());
        $this->content = $content;
    }

    /**
     * Creates a new request with values from PHP's super globals.
     *
     * @return static
     */
    public static function createFromGlobals()
    {
        return self::createRequestFromFactory($_GET, $_REQUEST, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    /**
     * @return ParamsBag
     */
    public function getRequestParams(): ParamsBag
    {
        return $this->requestParams;
    }

    /**
     * @return ParamsBag
     */
    public function getQueryParams(): ParamsBag
    {
        return $this->queryParams;
    }

    /**
     * @return ParamsBag
     */
    public function getAttributes(): ParamsBag
    {
        return $this->attributes;
    }

    /**
     * @return ServerBag
     */
    public function getServerParams(): ServerBag
    {
        return $this->serverParams;
    }

    /**
     * @return ParamsBag
     */
    public function getHeaders(): ParamsBag
    {
        return $this->headers;
    }

    /**
     * @return ParamsBag
     */
    public function getFilesParams(): ParamsBag
    {
        return $this->filesParams;
    }

    /**
     * @return ParamsBag
     */
    public function getCookiesParams(): ParamsBag
    {
        return $this->cookiesParams;
    }

    /**
     * @return mixed|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed|null $content
     * @return Request
     */
    public function setContent($content): Request
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get a value from request
     *
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->requestParams->get($key);
    }

    /**
     * @param array $query
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @return static
     */
    protected static function createRequestFromFactory(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = []
    ): self {
        return new static($query, $request, $attributes, $cookies, $files, $server);
    }
}