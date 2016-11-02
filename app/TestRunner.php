<?php

namespace App;

class TestRunner extends \phpQuery
{
    /** @var string */
    private $responseBody;
    /** @var string */
    private $responseHeader;

    /**
     * @param $selector
     * @param int $expected
     * @return mixed
     * @throws \Exception
     */
    public function selectorExists($selector, $expected = 1)
    {
        $matches = pq($selector);
        $count = count($matches);
        if ($count != $expected) {
            throw new \Exception($selector . ' exists by count of ' . $count);
        }

        return $matches;
    }

    /**
     * @param $selector
     * @param $min
     * @param $max
     * @return mixed
     * @throws \Exception
     */
    public function selectorExistsByRange($selector, $min, $max)
    {
        $matches = pq($selector);
        $count = count($matches);
        if ($count < $min || $count > $max) {
            throw new \Exception($selector . ' exists by count of ' . $count);
        }

        return $matches;
    }

    /**
     * @param $selector
     * @param $text
     * @param int $expected
     * @return mixed
     * @throws \Exception
     */
    public function selectorTextExists($selector, $text, $expected = 1)
    {
        $matches = pq($selector);
        $count = 0;
        foreach ($matches as $match) {
            if (strpos($match->nodeValue, $text) !== false) {
                $count++;
            }
        }
        if ($count != $expected) {
            throw new \Exception($selector . ' exists by count of ' . $count);
        }

        return $matches;
    }

    /**
     * @param $selector
     * @param $regEx
     * @param int $expected
     * @return mixed
     * @throws \Exception
     */
    public function selectorTextExistsByRegex($selector, $regEx, $expected = 1)
    {
        $matches = pq($selector);
        $count = 0;
        foreach ($matches as $match) {
            if (preg_match($regEx, $match->nodeValue)) {
                $count++;
            }
        }
        if ($count != $expected) {
            throw new \Exception($selector . ' exists by count of ' . $count);
        }

        return $matches;
    }

    /**
     * @param $string
     * @param int $expected
     * @return mixed
     * @throws \Exception
     */
    public function existsInBody($string, $expected = 1) {
        $count = substr_count($this->responseBody, $string);
        if ($count != $expected) {
            throw new \Exception($string . ' exists by count of ' . $count);
        }

        return $this->responseBody;
    }

    /**
     * @param $regEx
     * @param int $expected
     * @return string
     * @throws \Exception
     */
    public function existsInBodyByRegEx($regEx, $expected = 1) {
        $count = preg_match_all($regEx, $this->responseBody);
        if ($count != $expected) {
            throw new \Exception($regEx . ' exists by count of ' . $count);
        }

        return $this->responseBody;
    }

    /**
     * @param $string
     * @param int $expected
     * @return string
     * @throws \Exception
     */
    public function existsInHeader($string, $expected = 1)
    {
//        var_dump($this->responseHeader);die;
        $count = substr_count($this->responseHeader, $string);
        if ($count != $expected) {
            throw new \Exception($string . ' exists by count of ' . $count);
        }

        return $this->responseBody;
    }

    /**
     * @param $regEx
     * @param int $expected
     * @return string
     * @throws \Exception
     */
    public function existsInHeaderByRegEx($regEx, $expected = 1)
    {
        $count = preg_match_all($regEx, $this->responseHeader);
        if ($count != $expected) {
            throw new \Exception($regEx . ' exists by count of ' . $count);
        }

        return $this->responseBody;
    }

    /**
     * @param string $path
     * @param int $expected
     * @throws \Exception
     */
    public function requestPath($path, $expected = 200)
    {
        $url = $this->getDomain() . $path;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode != $expected) {
            throw new \Exception($url . ' status code is ' . $httpCode);
        }

        curl_close($curl);

        list($this->responseHeader, $this->responseBody) = explode("\r\n\r\n", $response, 2);

        parent::newDocument($this->responseBody);
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @return string
     */
    public function getResponseHeader()
    {
        return $this->responseHeader;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    private function getDomain()
    {
        global $argv, $argc;
        if ($argc > 2) {
            return $argv[2];
        } else {
            throw new \Exception('no domain passed');
        }
    }

}