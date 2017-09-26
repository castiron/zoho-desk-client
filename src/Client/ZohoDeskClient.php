<?php namespace Castiron\ZohoDeskClient\Client;

use Castiron\ZohoDeskClient\Exception\ZohoDeskClientException;
use Castiron\ZohoDeskClient\Transport\JsonRestTransport;

/**
 * Class ZohoDeskClient
 * @package Castiron\ZohoDeskClient
 */
class ZohoDeskClient
{
    /**
     * @var JsonRestTransport
     */
    protected $transport;

    /**
     * @var string
     */
    protected $apiUrl = 'https://desk.zoho.com/api/v1';

    /**
     * ZohoDeskClient constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        if ($options['apiUrl']) {
            $this->apiUrl = $options['apiUrl'];
        }
        $this->initTransport($options);
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->apiUrl = $url;
    }

    /**
     * @param $uri
     * @param array $params
     * @return \Httpful\Request
     */
    public function get($uri, $params = [])
    {
        return $this->transport->get($this->apiUrl($uri), $params);
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $data
     * @return \Httpful\Request
     */
    public function post($uri, $params = [], $data = [])
    {
        return $this->transport->post($this->apiUrl($uri), $params, $data);
    }

    /**
     * @param array $options
     */
    protected function initTransport($options = [])
    {
        $this->transport = new JsonRestTransport($options);
    }

    /**
     * @param $uri
     * @return string
     * @throws ZohoDeskClientException
     */
    protected function apiUrl($uri)
    {
        if (!$uri) {
            throw new ZohoDeskClientException('Please provide a URI');
        }
        return rtrim($this->apiUrl, '/') . '/' . ltrim($uri, '/');
    }
}
