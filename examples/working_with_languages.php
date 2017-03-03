<?php

include __DIR__ . '/../vendor/autoload.php';

use AkamuraAsai\HackerRankAPI\HRCaller;

$caller = new HRCaller();

// Get the list of avaiable languages
$languages = $caller->get_languages()->languages;

// Get the code of C++ by using the Name
$cpp_code = $caller->langcode_by_name('C++');

// Get the code of C# by using the Slug
$go_code = $caller->langcode_by_slug('csharp');

echo '<pre>';
echo "List of Languages<br>" . print_r($languages, true);
echo "<br><br>Code of C++<br>" . print_r($cpp_code, true);
echo "<br><br>Code of C#<br>" . print_r($go_code, true);
echo '</pre>';