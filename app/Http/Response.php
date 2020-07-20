<?php

namespace App\Http;

/**
 * Class Response
 *
 * @package App\Routes
 */
class Response
{
    public function toXML()
    {
    }

    /**
     * Set JSON content and response code.
     *
     * @param array $content
     * @param int $statusCode
     */
    public function toJSON(array $content = [], $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');

        echo json_encode($content);
    }
}
