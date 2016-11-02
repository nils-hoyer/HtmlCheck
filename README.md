## HtmlCheck
this test tool is a easy way to check html elements and text by criteria

####steps:
1. composer install to get the dependencies
2. create new test class in tests/
3. extend \App\TestCase
4. write your business tests
5. execute via phpunit: "phpunit tests/{className}.php {domain}"

or

4. take a look at ExampleTest.php
5. run "phpunit tests/ExampleTest.php https://en.wikipedia.org"

####functions:
* selectorExists(selector) //exists
* selectorExists(selector, 0) //not exists
* selectorExists(selector, 5)
* selectorExistsByRange(selector, 0, 1) //can exists
* selectorExistsByRange(selector, 1, 3)
* selectorTextExists(selector, text) //exists
* selectorTextExists(selector, text, 0) //not exists
* selectorTextExists(selector, text, 5)
* selectorTextExistsByRegex(selector, regEx) //exists
* selectorTextExistsByRegex(selector, regEx, 0) //not exists
* selectorTextExistsByRegex(selector, regEx, 5)
* existsInBody(string) //exists
* existsInBody(string, 0) //not exists
* existsInBody(string, 5)
* existsInBodyByRegEx(regEx) //exists
* existsInBodyByRegEx(regEx, 0) //not exists
