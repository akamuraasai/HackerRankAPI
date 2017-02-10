<?php

namespace AkamuraAsai\HackerRankAPI;


class HRController
{

    function __construct($apiClient) {
        $this->apiClient = $apiClient;
    }

    public function submission($api_key, $source, $lang, $testcases, $format, $callback_url=null, $wait=null) {

        //parse inputs
        $resourcePath = "/checker/submission.json";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        //make the API Call
        if (! isset($body)) {
            $body = null;
        }

        //HACK: form parameter
        $has_fields = False;
        $formParameters = array();
        $has_fields = True;
        $formParameters["api_key"] = $api_key;
        $has_fields = True;
        $formParameters["source"] = $source;
        $has_fields = True;
        $formParameters["lang"] = $lang;
        $has_fields = True;
        $formParameters["testcases"] = $testcases;
        $has_fields = True;
        $formParameters["format"] = $format;
        $has_fields = True;
        $formParameters["callback_url"] = $callback_url;
        $has_fields = True;
        $formParameters["wait"] = $wait;
        if ($has_fields) {
            $body = http_build_query($formParameters);
        }

        $response = $this->apiClient->callAPI($resourcePath, $method,
            $queryParams, $body,
            $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
            'Submission');
        return $responseObject;

    }


    public function languages() {

        //parse inputs
        $resourcePath = "/checker/languages.json";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        //make the API Call
        if (! isset($body)) {
            $body = null;
        }

        //HACK: form parameter
        $has_fields = False;
        $formParameters = array();
        if ($has_fields) {
            $body = http_build_query($formParameters);
        }

        $response = $this->apiClient->callAPI($resourcePath, $method,
            $queryParams, $body,
            $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
            'LanguageResponse');
        return $responseObject;

    }

}