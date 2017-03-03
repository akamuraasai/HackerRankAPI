<?php

namespace AkamuraAsai\HackerRankAPI;

use Dotenv\Dotenv;

class HRCaller
{

    protected $apiClient;
    protected $controller;

    public function __construct()
    {
        $env = new Dotenv(dirname(dirname(__DIR__)));
        $env->load();

        $this->apiClient = new APIClient();
        $this->controller = new HRController($this->apiClient);
    }

    public function use_testcases($code, $lang, $cases)
    {
        return $this->controller->submission(
                getenv('HACKERRANK_API_KEY'),
                $code,
                $lang,
                $cases,
                'json',
                null,
                true);
    }

    public function get_languages()
    {
        return $this->controller->languages();
    }

    public function langcode_by_name($name)
    {
        $languages = $this->get_languages()->languages;
        $slug = $this->in_object($name, $languages->names);
        if ($slug === false) return ['status' => -1, 'msg' => 'Language not found.'];

        $code = $this->langcode_by_slug($slug, true, $languages);
        if ($code === false) return ['status' => -1, 'msg' => 'Error on getting the code.'];
        return ['status' => 0, 'msg' => $code];
    }

    public function langcode_by_slug($slug, $byName = null, $languages = null)
    {
        if ($byName) return $this->in_object($slug, $languages->codes, true);

        $languages = $this->get_languages()->languages;
        $code = $this->in_object($slug, $languages->codes, true);
        if ($code === false) return ['status' => -1, 'msg' => 'Error on getting the code.'];
        return ['status' => 0, 'msg' => $code];;
    }

    protected function in_object($val, $obj, $checkByKey = false)
    {

        if ($val == "") {
            trigger_error("in_object expects parameter 1 must not empty", E_USER_WARNING);
            return false;
        }
        if (!is_object($obj)) {
            $obj = (object)$obj;
        }

        foreach ($obj as $key => $value) {
            if (!is_object($value) && !is_array($value)) {
                if ($checkByKey && $key == $val) return $value;
                else if (!$checkByKey && $value == $val) return $key;
            } else {
                return in_object($val, $value);
            }
        }
        return false;
    }
}