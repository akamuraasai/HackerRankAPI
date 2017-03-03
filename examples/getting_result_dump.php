<?php

include __DIR__ . '/../vendor/autoload.php';

use AkamuraAsai\HackerRankAPI\HRCaller;

/*
    Problem Description
    --------------------------------------------------------------------------
    You are given an array of integers of size.
    You need to print the sum of the elements in the array,
    keeping in mind that some of those integers may be quite large.

    Input Format
    ---------------------------------------
    The first line of the input consists of an integer.
    The next line contains  space-separated integers contained in the array.

    Output Format
    ---------------------------------------
    Print a single value equal to the sum of the elements in the array.
*/


$caller = new HRCaller();

$code = '#!/bin/ruby

        n = gets.strip.to_i
        arr = gets.strip
        arr = arr.split(" ").map(&:to_i)
        
        result = 0
        for x in arr
            result += x
        end
        
        print result';

$language = 8; //Ruby
$testcases = [
    ['input' => '5\n1000000001 1000000002 1000000003 1000000004 1000000005', 'output' => '5000000015'],
    ['input' => '10\n1001458909 1004570889 1007019111 1003302837 1002514638 1006431461 1002575010 1007514041 1007548981 1004402249', 'output' => '10047338126']
];


$test_inputs = '[';
foreach ($testcases as $test)
    $test_inputs .= '"' . $test['input'] . '", ';
$test_inputs = rtrim($test_inputs, ', ');
$test_inputs .= ']';


$result = $caller->use_testcases($code, $language, $test_inputs)->result;
// This sample focus is to show the Result object and his contents.
echo '<pre>';
echo print_r($result, true);
echo '</pre>';