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
     * @param array|object $content
     * @param int $statusCode
     */
    public function toJSON($content, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        printf('%s', json_encode($content, JSON_PRETTY_PRINT));
    }
}
