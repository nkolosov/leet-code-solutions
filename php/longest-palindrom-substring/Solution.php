<?php


class Solution
{
    protected $palindromes = [];

    function isPalindrom($s)
    {
        $len = strlen($s);
        if (in_array(substr($s, 0, $len - 1), $this->palindromes)) {
            return false;
        }

        if (in_array(substr($s, 1, $len - 1), $this->palindromes)) {
            return false;
        }

        if ($this->compareSubstring($s, 0, $len)) {
            $this->palindromes[] = $s;
            return true;
        }

        return false;
    }

    function getIndex($i, $len)
    {
        if ($len == 1) {
            return $i;
        }

        if ($len == 2) {
            return $i + 1;
        }

        if ($len % 2 == 1) {
            return (int)($i + ($len / 2));
        }

        return (int)($i + ceil($len / 2));
    }

    function getPartLength($len)
    {
        if ($len % 2 == 0) {
            return $len / 2;
        } else {
            return ($len + 1) / 2;
        }
    }

    function getLeft($s, $i, $len)
    {
        return substr($s, $i, $this->getPartLength($len));
    }

    function getRight($s, $i, $len)
    {
        return substr($s, $this->getIndex($i, $len), $this->getPartLength($len));
    }

    function compareSubstring($s, $i, $len)
    {
        if ($len == 1) {
            return true;
        }

        $a = $this->getLeft($s, $i, $len);
        $b = $this->getRight($s, $i, $len);

        if ($a == strrev($b)) {
            return true;
        }

        return false;
    }

    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s)
    {
        $l = strlen($s);
        $maxPalindromLength = 1;

        $index = 0;
        for ($i = 0; $i <= $l - $maxPalindromLength; $i++) {
            for ($currentPalindromLength = $maxPalindromLength; $currentPalindromLength < $l - $i + 1; $currentPalindromLength++) {
                $str = substr($s, $i, $currentPalindromLength);
                if ($this->isPalindrom($str)) {
                    $index = $i;
                    $maxPalindromLength = $currentPalindromLength;
                }
            }

        }

        return substr($s, $index, $maxPalindromLength);
    }
}

