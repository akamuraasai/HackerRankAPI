<?php

namespace AkamuraAsai\HackerRankAPI;

class APIClient
{

    public static $POST = "POST";
    public static $GET = "GET";
    public static $PUT = "PUT";
    public static $DELETE = "DELETE";
    public static $PATCH = "PATCH";

    function __construct($apiServer = 'http://api.hackerrank.com') {
        $this->apiKey = 'hackerrank|665905-1221|d2773ca40a490d766a3910926e0a4c0488eed803';
        $this->apiServer = $apiServer;
    }


    public function callAPI($resourcePath, $method, $queryParams, $postData,
                            $headerParams) {

        $headers = array();

        $added_api_key = False;
        if ($headerParams != null) {
            foreach ($headerParams as $key => $val) {
                $headers[] = "$key: $val";
            }
        }

        if (is_object($postData) or is_array($postData)) {
            $postData = json_encode($this->sanitizeForSerialization($postData));
        }

        $url = $this->apiServer . $resourcePath;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        // return the result on success, rather than just TRUE
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if (! empty($queryParams)) {
            $url = ($url . '?' . http_build_query($queryParams));
        }

        if ($method == self::$POST) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$PUT) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$DELETE) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$PATCH) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method != self::$GET) {
            throw new \Exception('Method ' . $method . ' is not recognized.');
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        // Set agent
        curl_setopt($curl, CURLOPT_USERAGENT,'Swagger/PHP/0.0.5/beta');
        // Set empty expect
        curl_setopt($curl, CURLOPT_HTTPHEADER,array("Expect:"));

        // Make the request
        $response = curl_exec($curl);
        $response_info = curl_getinfo($curl);

//        echo $response; die();


        // Handle the response
        if ($response_info['http_code'] == 0) {
            throw new \Exception("TIMEOUT: api call to " . $url .
                " took more than 5s to return" );
        } else if ($response_info['http_code'] >= 200 && $response_info['http_code'] <= 299) {
            $data = json_decode($response);
            if (json_last_error() > 0) {
                $data = $response;
            }
        } else if ($response_info['http_code'] == 401) {
            throw new \Exception("Unauthorized API request to " . $url .
                ": ".serialize($response) );
        } else if ($response_info['http_code'] == 404) {
            $data = null;
        } else {
            throw new \Exception("Can't connect to the api: " . $url .
                " response code: " .
                $response_info['http_code']);
        }

        return $data;
    }

    protected function sanitizeForSerialization($data)
    {
        if (is_scalar($data) || null === $data) {
            $sanitized = $data;
        } else if ($data instanceof \DateTime) {
            $sanitized = $data->format(\DateTime::ISO8601);
        } else if (is_array($data)) {
            foreach ($data as $property => $value) {
                $data[$property] = $this->sanitizeForSerialization($value);
            }
            $sanitized = $data;
        } else if (is_object($data)) {
            $values = array();
            foreach (array_keys($data::$swaggerTypes) as $property) {
                if (!is_null($this->sanitizeForSerialization($data->$property))) {
                    $values[$property] = $this->sanitizeForSerialization($data->$property);
                }
            }
            $sanitized = $values;
        } else {
            $sanitized = (string)$data;
        }

        return $sanitized;
    }

    public static function toPathValue($value) {
        return rawurlencode($value);
    }

    public static function toQueryValue($object) {
        if (is_array($object)) {
            return implode(',', $object);
        } else {
            return $object;
        }
    }

    public static function toHeaderValue($value) {
        return $value;
    }

    public static function deserialize($data, $class)
    {
        if (null === $data) {
            $deserialized = null;
        } else if (strcasecmp(substr($class, 0, 6),'array[') == 0) {
            $subClass = substr($class, 6, -1);
            $values = array();
            foreach ($data as $value) {
                $values[] = self::deserialize($value, $subClass);
            }
            $deserialized = $values;
        } elseif ($class == 'DateTime') {
            $deserialized = new \DateTime($data);
        } elseif (in_array($class, array('string', 'int', 'integer', 'number', 'float', 'bool'))) {
            if ($class == 'number') { //HACK map number to float
                $class = 'float';
            }
            settype($data, $class);
            $deserialized = $data;
        } else {
            #HACK
            $class = "AkamuraAsai\\HackerRankAPI\\Models\\".$class;
            $instance = new $class();
            foreach ($instance::$swaggerTypes as $property => $type) {
                if (isset($data->$property)) {
                    $instance->$property = self::deserialize($data->$property, $type);
                }
            }
            $deserialized = $instance;
        }

        return $deserialized;
    }

}