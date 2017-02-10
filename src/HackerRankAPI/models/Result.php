<?php
/**
 * Created by PhpStorm.
 * User: jonathan.cruz
 * Date: 10/02/2017
 * Time: 15:53
 */

namespace AkamuraAsai\HackerRankAPI\models;


class Result
{

    static $swaggerTypes = array(
        'callback_url' => 'string',
        'censored_compile_message' => 'string',
        'censored_stderr' => 'array[string]',
        'codechecker_hash' => 'string',
        'compilemessage' => 'string',
        'created_at' => 'DateTime',
        'custom_score' => 'string',
        'custom_status' => 'string',
        'diff_status' => 'string',
        'hash' => 'string',
        'memory' => 'array[int]',
        'message' => 'array[string]',
        'result' => 'int',
        'server' => 'string',
        'signal' => 'array[int]',
        'stderr' => 'array[bool]',
        'stdout' => 'array[string]',
        'time' => 'array[float]'

    );

    /**
     * Callback URL
     */
    public $callback_url; // string
    /**
     * Censored compile message
     */
    public $censored_compile_message; // string
    /**
     * Censored stderr
     */
    public $censored_stderr; // array[string]
    /**
     * Codechecker hash
     */
    public $codechecker_hash; // string
    /**
     * Compilemessage
     */
    public $compilemessage; // string
    /**
     * Created at
     */
    public $created_at; // DateTime
    /**
     * Custom score
     */
    public $custom_score; // string
    /**
     * Custom status
     */
    public $custom_status; // string
    /**
     * Diff status
     */
    public $diff_status; // string
    /**
     * Hash
     */
    public $hash; // string
    /**
     * Memory
     */
    public $memory; // array[int]
    /**
     * Message
     */
    public $message; // array[string]
    /**
     * Result
     */
    public $result; // int
    /**
     * Server
     */
    public $server; // string
    /**
     * Signal
     */
    public $signal; // array[int]
    /**
     * Stderr
     */
    public $stderr; // array[bool]
    /**
     * Stdout
     */
    public $stdout; // array[string]
    /**
     * Time
     */
    public $time; // array[float]

}