<?php

/**
 * execute tests via command line
 * phpunit tests/ExampleTest.php https://en.wikipedia.org
 */
class ExampleTest extends \App\TestCase
{
    /** @var string */
    private $path = "/wiki/Smoke_testing_(software)";

    public function testSelectorExists()
    {
        $this->html->requestPath($this->path);
        $this->html->selectorExists("#mw-panel .portal", 5);
    }

    public function testSelectorNotExists()
    {
        $this->html->requestPath($this->path);
        $this->html->selectorExists("#this-selector-not-exists", 0);
    }

    /**
     * @dataProvider routes
     */
    public function testHttpCode($route)
    {
        $this->html->requestPath($route, 301);
    }

    /**
     * @group critical
     */
    public function testSelectorTextExists()
    {
        $this->html->requestPath($this->path);
        $this->html->selectorTextExists("title", "Smoke testing (software) - Wikipedia");
    }

    public function testSelectorExistsByRange()
    {
        $this->html->requestPath($this->path);
        $this->html->selectorExistsByRange("#mw-content-text", 0, 1);
    }

    public function testSelectorTextExistsByRegex()
    {
        $this->html->requestPath($this->path);
        $this->html->selectorTextExistsByRegex("#firstHeading", "/Smoke.*/");
    }

    public function testSelectorTextNotExistsByRegex()
    {
        $this->html->requestPath($this->path);
        $this->html->selectorTextExistsByRegex("#firstHeading", "/functional.*testing/", 0);
    }

    public function testExists()
    {
        $this->html->requestPath($this->path);
        $this->html->existsInBody("<b>confidence testing</b>");
    }

    public function testExistsByRegEx()
    {
        $this->html->requestPath($this->path);
        $this->html->existsInBodyByRegEx("/func.*ns/", 5);
    }

    public function testExistsInHeader()
    {
        $this->html->requestPath($this->path);
        $this->html->existsInHeader("Vary: Accept-Encoding,Cookie,Authorization");
    }

    public function testExistsInHeaderByRegEx()
    {
        $this->html->requestPath($this->path);
        $this->html->existsInHeaderByRegEx("/Last-Modified:.*GMT/");
    }

    public function routes()
    {
        return [
            ['/'],
            ['/wiki/']
        ];
    }

}