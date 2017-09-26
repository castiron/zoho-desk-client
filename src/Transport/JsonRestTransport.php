<?php namespace Castiron\ZohoDeskClient\Transport;

use Castiron\ZohoDeskClient\Exception\ZohoDeskClientException;
use Castiron\ZohoDeskClient\Utility\UrlUtility;
use Httpful\Request;

/**
 * Class JsonRestTransport
 * @package Castiron\ZohoDeskClient\Transport
 */
class JsonRestTransport
{
    /**
     * JsonRestTransport constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        if ($options['apiUrl']) {
            $this->apiUrl = $options['apiUrl'];
        }
        $this->initClient($options);
    }

    /**
     * @param string $url
     * @param array $params
     * @return Request
     */
    public function get($url, $params = [])
    {
        $url = UrlUtility::addQueryStringParams($url, $params);
        return Request::get($url);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $data
     * @return Request
     */
    public function post($url, $params = [], $data = [])
    {
        $url = UrlUtility::addQueryStringParams($url, $params);
        return Request::post($url)
            ->body(static::json_encode($data));
    }

    /**
     * This will set some global options for all Httpful requests
     * @param array $options
     */
    protected function initClient($options = [])
    {
        $baseRequest = Request::init()
            ->expectsJson()
            ->addHeaders([
                'Authorization' => 'Zoho-authtoken ' . $options['token'],
                'orgId' => $options['orgId'],
            ]);
        Request::ini($baseRequest);
    }

    /**
     * @param $obj
     * @return string
     * @throws ZohoDeskClientException
     */
    protected static function json_encode($obj)
    {
        $json = \json_encode($obj);
        if (0 !== json_last_error()) {
            throw new ZohoDeskClientException(
                'json_encode error: ' . json_last_error_msg()
            );
        }

        return $json;
    }
}

