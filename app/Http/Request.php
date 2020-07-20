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
    public $response;

    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $reqMethod;

    /**
     * @var string
     */
    private $contentType;

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
        return $this->params;
    }

    /**
     * @return array
     */
    public function parseJSON()
    {
        if ($this->reqMethod !== 'POST' || strcasecmp($this->contentType, 'application/json') !== 0) {
            return [];
        }

        $jsonContent = trim(file_get_contents("php://input"));

        return json_decode($jsonContent);
    }
}
