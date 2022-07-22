<?php

class Solution
{

    /**
     * @param String $s
     * @return String
     */
    public function longestPalindrome(string $s): string
    {
        if ($s == null || strlen($s) < 1) {
            return "";
        }
        $start = $end = 0;
        $maxLen = 1;
        for ($i = 0; $i < strlen($s) - 1; $i++) {
            list($len1, $val1) = $this->expandAroundCenter($s, $i, $i);
            list($len2, $val2) = $this->expandAroundCenter($s, $i, $i+1);
            $len = max($len1, $len2);
            if ($len > $maxLen) {
                $maxLen = $len;
            }

            if ($len > ($end - $start)) {
                $start = (int) ($i - floor(($len - 1) / 2));
                $end = (int) ($i +  floor($len / 2));
            }
        }

        return substr($s, $start, $maxLen);;
    }

    protected function expandAroundCenter(string $s, int $left, int $right) {
        $L = $left;
        $R = $right;

        while ($L >= 0 && $R < strlen($s) && $s[$L] == $s[$R]) {
            $L--;
            $R++;
        }

        return [$R - $L - 1, substr($s, $L, $R - $L - 1)];
    }

}

