<?php

/**
 * 會用到的工具 (收集區)
 *
 * @package Hiiir\Tools
 * @author coffeecan hugo_wang@hiiir.com 
 * @version 1.0
 */
class Tools
{

	function tools() {
		//不需要連資料庫
	}


    /**
     * 用來格式化輸出的部份，避免內嵌js語法
     *
     * @param String $text
     * @return 格式化後的$text
     */
    function FormatTxt($text) 
    {
        $text = str_replace( "$", "", $text);
        return htmlspecialchars(strip_tags(stripslashes(trim($text))));
    }


    /**
     * 將BIG5的文字轉換成UTF8
     *
     * @param String $Msg
     * @return 轉換後的文字
     */
    function BIG52UTF($Msg)
    {
        $result = iconv("big5", "UTF-8//TRANSLIT", $Msg);
        return trim($result);
    }


    /**
     * 將UTF-8的文字轉換成BIG5
     *
     * @param String $Msg
     * @return 轉換後的文字
     */
    function UTF2BIG($Msg)
    {
        $result = iconv("UTF-8","big5//TRANSLIT",$Msg);
        return trim($result);
    }





    /**
     * 將需要引用在資料庫查詢等等中的字元前面加上反斜線，傳回加上反斜線的字串，
     * 這些字元有單引號(')、雙引號( " )、斜線( \ )及NULL(null byte)
     *
     */
    function checkGetPost()
    {
        if (!get_magic_quotes_gpc()) {
            
            if (is_array($_GET)) {
                while (list($k, $v) = each($_GET)) {
                    if (is_array($_GET[$k])) {
                        while (list($k2, $v2) = each($_GET[$k])) {
                            $_GET[$k][$k2] = addslashes($v2);
                        }
                        @reset($_GET[$k]);
                    } else {
                        $_GET[$k] = addslashes($v);
                    }
                }
                @reset($_GET);
            }

            if (is_array($_POST)) {
                while (list($k, $v) = each($_POST)) {
                    if (is_array($_POST[$k])) {
                        while (list($k2, $v2) = each($_POST[$k])) {
                            $_POST[$k][$k2] = addslashes($v2);
                        }
                        @reset($_POST[$k]);
                    } else {
                        $_POST[$k] = addslashes($v);
                    }
                }
                @reset($_POST);
            }

            if (is_array($_COOKIE)) {
                while (list($k, $v) = each($_COOKIE)) {
                    if (is_array($_COOKIE[$k])) {
                        while (list($k2, $v2) = each($_COOKIE[$k])) {
                            $_COOKIE[$k][$k2] = addslashes($v2);
                        }
                        @reset($_COOKIE[$k]);
                    } else {
                        $_COOKIE[$k] = addslashes($v);
                    }
                }
                @reset($_COOKIE);
            }
        }
    }


    /**
     * js show and redirect
     *
     */
    public static function jsRedirect($url=false, $msg=false)
    {
        header('Content-Type: text/html; charset=utf-8'); 
        $str = "";
        if ($msg) {
            $str = sprintf("alert(\"%s\");", $msg);
        }
        $str .= $url?sprintf("location.href=\"%s\";", $url):"history.back(-1);";
        echo sprintf("<script language=\"javascript\">%s</script>", $str);
        exit;
    }

    public static function is_email($email, $checkDNS = false)
    {
        //  Check that $email is a valid address
        //      (http://tools.ietf.org/html/rfc3696)
        //      (http://tools.ietf.org/html/rfc5322#section-3.4.1)
        //      (http://tools.ietf.org/html/rfc5321#section-4.1.3)
        //      (http://tools.ietf.org/html/rfc4291#section-2.2)
        //      (http://tools.ietf.org/html/rfc1123#section-2.1)

        //  Contemporary email addresses consist of a "local part" separated from
        //  a "domain part" (a fully-qualified domain name) by an at-sign ("@").
        //      (http://tools.ietf.org/html/rfc3696#section-3)
        $index = strrpos($email,'@');

        if ($index === false)       return false;   //  No at-sign
        if ($index === 0)           return false;   //  No local part
        if ($index > 64)            return false;   //  Local part too long

        $localPart      = substr($email, 0, $index);
        $domain         = substr($email, $index + 1);
        $domainLength   = strlen($domain);

        if ($domainLength === 0)    return false;   //  No domain part
        if ($domainLength > 255)    return false;   //  Domain part too long

        //  Let's check the local part for RFC compliance...
        //
        //  Period (".") may...appear, but may not be used to start or end the
        //  local part, nor may two or more consecutive periods appear.
        //      (http://tools.ietf.org/html/rfc3696#section-3)
        if (preg_match('/^\\.|\\.\\.|\\.$/', $localPart) > 0)               return false;   //  Dots in wrong place

        //  Any ASCII graphic (printing) character other than the
        //  at-sign ("@"), backslash, double quote, comma, or square brackets may
        //  appear without quoting.  If any of that list of excluded characters
        //  are to appear, they must be quoted
        //      (http://tools.ietf.org/html/rfc3696#section-3)
        if (preg_match('/^"(?:.)*"$/', $localPart) > 0) {
            //  Local part is a quoted string
            if (preg_match('/(?:.)+[^\\\\]"(?:.)+/', $localPart) > 0)   return false;   //  Unescaped quote character inside quoted string
        } else {
            if (preg_match('/[ @\\[\\]\\\\",]/', $localPart) > 0)
                //  Check all excluded characters are escaped
                $stripped = preg_replace('/\\\\[ @\\[\\]\\\\",]/', '', $localPart);
            if (preg_match('/[ @\\[\\]\\\\",]/', $stripped) > 0)        return false;   //  Unquoted excluded characters
        }

        //  Now let's check the domain part...

        //  The domain name can also be replaced by an IP address in square brackets
        //      (http://tools.ietf.org/html/rfc3696#section-3)
        //      (http://tools.ietf.org/html/rfc5321#section-4.1.3)
        //      (http://tools.ietf.org/html/rfc4291#section-2.2)
        if (preg_match('/^\\[(.)+]$/', $domain) === 1) {
            //  It's an address-literal
            $addressLiteral = substr($domain, 1, $domainLength - 2);
            $matchesIP      = array();

            //  Extract IPv4 part from the end of the address-literal (if there is one)
            if (preg_match('/\\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $addressLiteral, $matchesIP) > 0) {
                $index = strrpos($addressLiteral, $matchesIP[0]);

                if ($index === 0) {
                    //  Nothing there except a valid IPv4 address, so...
                    return true;
                } else {
                    //  Assume it's an attempt at a mixed address (IPv6 + IPv4)
                    if ($addressLiteral[$index - 1] !== ':')            return false;   //  Character preceding IPv4 address must be ':'
                    if (substr($addressLiteral, 0, 5) !== 'IPv6:')      return false;   //  RFC5321 section 4.1.3

                    $IPv6 = substr($addressLiteral, 5, ($index ===7) ? 2 : $index - 6);
                    $groupMax = 6;
                }
            } else {
                //  It must be an attempt at pure IPv6
                if (substr($addressLiteral, 0, 5) !== 'IPv6:')          return false;   //  RFC5321 section 4.1.3
                $IPv6 = substr($addressLiteral, 5);
                $groupMax = 8;
            }

            $groupCount = preg_match_all('/^[0-9a-fA-F]{0,4}|\\:[0-9a-fA-F]{0,4}|(.)/', $IPv6, $matchesIP);
            $index      = strpos($IPv6,'::');

            if ($index === false) {
                //  We need exactly the right number of groups
                if ($groupCount !== $groupMax)                          return false;   //  RFC5321 section 4.1.3
            } else {
                if ($index !== strrpos($IPv6,'::'))                     return false;   //  More than one '::'
                $groupMax = ($index === 0 || $index === (strlen($IPv6) - 2)) ? $groupMax : $groupMax - 1;
                if ($groupCount > $groupMax)                            return false;   //  Too many IPv6 groups in address
            }

            //  Check for unmatched characters
            array_multisort($matchesIP[1], SORT_DESC);
            if ($matchesIP[1][0] !== '')                                    return false;   //  Illegal characters in address

            //  It's a valid IPv6 address, so...
            return true;
        } else {
            //  It's a domain name...

            //  The syntax of a legal Internet host name was specified in RFC-952
            //  One aspect of host name syntax is hereby changed: the
            //  restriction on the first character is relaxed to allow either a
            //  letter or a digit.
            //      (http://tools.ietf.org/html/rfc1123#section-2.1)
            //
            //  NB RFC 1123 updates RFC 1035, but this is not currently apparent from reading RFC 1035.
            //
            //  Most common applications, including email and the Web, will generally not permit...escaped strings
            //      (http://tools.ietf.org/html/rfc3696#section-2)
            //
            //  Characters outside the set of alphabetic characters, digits, and hyphen MUST NOT appear in domain name
            //  labels for SMTP clients or servers
            //      (http://tools.ietf.org/html/rfc5321#section-4.1.2)
            //
            //  RFC5321 precludes the use of a trailing dot in a domain name for SMTP purposes
            //      (http://tools.ietf.org/html/rfc5321#section-4.1.2)
            $matches    = array();
            $groupCount = preg_match_all('/(?:[0-9a-zA-Z][0-9a-zA-Z-]{0,61}[0-9a-zA-Z]|[a-zA-Z])(?:\\.|$)|(.)/', $domain, $matches);
            $level      = count($matches[0]);

            if ($level == 1)                                            return false;   //  Mail host can't be a TLD

            $TLD = $matches[0][$level - 1];
            if (substr($TLD, strlen($TLD) - 1, 1) === '.')              return false;   //  TLD can't end in a dot
            if (preg_match('/^[0-9]+$/', $TLD) > 0)                     return false;   //  TLD can't be all-numeric

            //  Check for unmatched characters
            array_multisort($matches[1], SORT_DESC);
            if ($matches[1][0] !== '')                          return false;   //  Illegal characters in domain, or label longer than 63 characters

            //  Check DNS?
            if ($checkDNS && function_exists('checkdnsrr')) {
                if (!(checkdnsrr($domain, 'A') || checkdnsrr($domain, 'MX'))) {
                    return false;   //  Domain doesn't actually exist
                }
            }

            //  Eliminate all other factors, and the one which remains must be the truth.
            //      (Sherlock Holmes, The Sign of Four)
            return true;
        }
    }


    private function trance_HTML_ENTITIES($str)
    {
        $trans = get_html_translation_table(HTML_ENTITIES);
        //$encoded = strtr ($str, $trans);
        $trans = array_flip($trans);
        return strtr($str, $trans);
    }

    //SQL Injection專用
    public function sql_injection_anti($str)
    {
        if (sprintf("%d", $str) == $str)
        {
            return $str;
        }
        $trance_str = $this->trance_HTML_ENTITIES($str);
        $trance_str = str_replace(array('\\"', "\\'"), array('"', "'"), $trance_str);
        $new_str = mysql_escape_string($trance_str);
        return $new_str;
    }
}
?>