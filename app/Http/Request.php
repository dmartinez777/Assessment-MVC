<?php

namespace App\Http;

/**
 * Class Request
 *
 * @package App\Routing
 */
class Request
{
    /**
     * @var Response
     */
    public Response $response;

    /**
     * @var array
     */
    public array $params;

    /**
     * @var string
     */
    private string $reqMethod;

    /**
     * @var string
     */
    private string $contentType;

    /**
     * Request constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params      = $params;
        $this->response    = new Response();
        $this->contentType = (isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '');
        $this->reqMethod   = trim($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public function getMethodUsed()
    {
        return $this->reqMethod;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params[0];
    }

    /**
     * @return array
     */
    public function getJSON()
    {
        if ($this->reqMethod !== 'POST' || strcasecmp($this->contentType, 'application/json') !== 0) {
            return [];
        }

        $jsonContent = trim(file_get_contents("php://input"));

        return json_decode($jsonContent);
    }
}
