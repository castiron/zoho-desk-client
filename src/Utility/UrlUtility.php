<?php namespace Castiron\ZohoDeskClient\Utility;

/**
 * Class UrlUtility
 * @package Castiron\ZohoDeskClient\Utility
 */
class UrlUtility
{
    /**
     * @param $url
     * @param $params
     * @return string
     */
    public static function addQueryStringParams($url, $params)
    {
        if (!$params) {
            return $url;
        }

        $parsed = parse_url($url);
        $parsed['query'] = static::overlayParams($parsed['query'], $params);
        return http_build_url($parsed);
    }

    /**
     * @param $queryString
     * @return array
     */
    protected static function splitQueryString($queryString)
    {
        if (!$queryString) {
            return [];
        }
        return explode('&', $queryString);
    }

    /**
     * @param $queryString
     * @param array $params
     * @return string
     */
    protected static function overlayParams($queryString, $params = [])
    {
        /**
         * No query string provided -- let's just create one
         */
        if (!$queryString) {
            return http_build_query($params);
        }

        /**
         * Let's split the query string and jam our new values onto it
         */
        $split = static::splitQueryString($queryString);
        return http_build_query(array_merge($split, $params));
    }
}
