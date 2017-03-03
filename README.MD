## Hacker Rank API

This package consumes the Hacker Rank API, evaluating a given code and returning de output of the operation.

> An example file is included with informations about how to use this package properly.

#### How to use
 
 First you'll need a HackerRank API Key that's can be acquired [here](https://www.hackerrank.com/api/docs).
 
 Make a copy of the ```.env.example``` file and rename it to ```.env```. 
 Inside the file, change the ```HACKERRANK_API_KEY``` value to your own key. 
 
 Then, just autoload the library and call it like this:
 
 ```php
 use AkamuraAsai\HackerRankAPI\HRCaller;
 
 $caller = new HRCaller();
 $result = $caller->use_testcases($code, $language, $test_inputs)->result;
 
 ```
 Where `$code` is a variable containing the code that will run in Hacker Rank servers.
 The `$language` var is a integer containing the code of language used on above code.
 Last one `$test_inputs` containing the inputs of the tests that the code will run about.
 
 The `use_testcases()` is the only function working for now. More will come in a future update.
 
#### List of Languages/Codes
 
| Code | Language     |
|:----:|--------------|
| 01   | C            |
| 02   | C++          |
| 03   | Java         |
| 05   | Python       |
| 06   | Perl         |
| 07   | PHP          |
| 08   | Ruby         |
| 09   | C#           |
| 10   | MySQL        |
| 11   | Oracle       |
| 12   | Haskell      |
| 13   | Clojure      |
| 14   | Bash         |
| 15   | Scala        |
| 16   | Erlang       |
| 18   | Lua          |
| 20   | JavaScript   |
| 21   | Go           |
| 22   | D            |
| 23   | Ocaml        |
| 24   | R            |
| 25   | Pascal       |
| 26   | SBCL         |
| 30   | Python 3     |
| 31   | Groovy       |
| 32   | Objective-C  |
| 33   | F#           |
| 36   | Cobol        |
| 37   | Visual Basic |
| 38   | LOL Code     |
| 39   | SmallTalk    |
| 40   | TCL          |
| 41   | Whitespace   |
| 42   | TSQL         |
| 43   | Java 8       |
| 44   | DB2          |
| 46   | Octave       |
| 48   | XQuery       |
| 49   | Racket       |
| 50   | Rust         |
| 51   | Swift        |
| 54   | Fortran      |


#### License
MIT license.

 