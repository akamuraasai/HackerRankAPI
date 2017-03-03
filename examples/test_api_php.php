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
$code = '<?php

        $handle = fopen ("php://stdin","r");
        fscanf($handle,"%d",$n);
        $arr_temp = fgets($handle);
        $arr = explode(" ",$arr_temp);
        array_walk($arr,\'intval\');
        
        $result = 0;
        foreach ($arr as $item) 
            $result += $item;
        echo $result;
        
        ?>';

$language = 7; //PHP
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
echo '<pre>';
for ($i = 0; $i < count($testcases); $i++)
    echo strcmp(trim($testcases[$i]['output']), trim($result->stdout[$i])) == 0 ? 'Correct Answer.<br>' : 'Try Again.<br>';
echo '</pre>';