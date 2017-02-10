<?php

namespace AkamuraAsai\HackerRankAPI;

class HRCaller
{

    public function use_testcases($code, $lang, $cases)
    {
        $apiClient = new APIClient();
        $controller = new HRController($apiClient);
        $result = $controller->submission(
                        'hackerrank|665905-1221|d2773ca40a490d766a3910926e0a4c0488eed803',
                        $code,
                        $lang,
                        $cases,
                        'json',
                        null,
                        true);
        return $result;
    }
}