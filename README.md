# HtmlCheck
this test tool is for easy checking html elements or text by critera

steps:
1. composer install to get the dependecies
2. create new test class in tests/
3. extend \App\TestCase
4. write your business tests
5. execute via phpunit: "phpunit tests/{className}.php {domain}"

or

4. take a look at ExampleTest.php
5. run "phpunit tests/ExampleTest.php https://en.wikipedia.org"

functions:
selectorExists($selector) //exists
selectorExists($selector, 0) //not exists
selectorExists($selector, 5)
selectorExistsByRange($selector, 0, 1) //can exists
selectorExistsByRange($selector, 1, 3)
selectorTextExists($selector, $text) //exists
selectorTextExists($selector, $text, 0) //not exists
selectorTextExists($selector, $text, 5)
selectorTextExistsByRegex($selector, $regEx) //exists
selectorTextExistsByRegex($selector, $regEx, 0) //not exists
selectorTextExistsByRegex($selector, $regEx, 5)
existsInBody($string) //exists
existsInBody($string, 0) //not exists
existsInBody($string, 5)
existsInBodyByRegEx($regEx) //exists
existsInBodyByRegEx($regEx, 0) //not exists
existsInBodyByRegEx($regEx, 5)
existsInHeader($string) //exists
existsInHeader($string, 0) //not exists
existsInHeader($string, 5)
existsInHeaderByRegEx($regEx) //exists
existsInHeaderByRegEx($regEx, 0) //not exists
existsInHeaderByRegEx($regEx, 5)
requestPath($path) //expect 200 httpcode
requestPath($path, 301)
getResponseBody()
getResponseHeader()
