<?php

class Util
{

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

    //ARRAY排序，可針對ARRAY中的某個欄位做排序
    public function sticky_sort($arr, $field, $sort_type, $sticky_fields = array())
    {
        $i = 0;
        if (sizeof($arr))
            foreach ($arr as $value)
            {
                $is_contiguous = true;
                if (!empty($grouped_arr))
                {
                    $last_value = end($grouped_arr[$i]);

                    if (!($sticky_fields == array()))
                    {
                        foreach ($sticky_fields as $sticky_field)
                        {
                            if ($value[$sticky_field] <> $last_value[$sticky_field])
                            {
                                $is_contiguous = false;
                                break;
                            }
                        }
                    }
                }
                if ($is_contiguous)
                    $grouped_arr[$i][] = $value;
                else
                    $grouped_arr[++$i][] = $value;
            }
        $code = '';
        switch ($sort_type)
        {
            case "ASC_AZ":
                $code .= 'return strcasecmp($a["' . $field . '"], $b["' . $field . '"]);';
                break;
            case "DESC_AZ":
                $code .= 'return (-1*strcasecmp($a["' . $field . '"], $b["' . $field . '"]));';
                break;
            case "ASC_NUM":
                $code .= 'return ($a["' . $field . '"] > $b["' . $field . '"]);';
                break;
            case "DESC_NUM":
                $code .= 'return ($b["' . $field . '"] > $a["' . $field . '"]);';
                break;
        }

        $compare = create_function('$a, $b', $code);

        if (sizeof($grouped_arr))
            foreach ($grouped_arr as $grouped_arr_key => $grouped_arr_value)
                usort($grouped_arr[$grouped_arr_key], $compare);

        $arr = array();
        if (sizeof($grouped_arr))
            foreach ($grouped_arr as $grouped_arr_key => $grouped_arr_value)
                foreach ($grouped_arr[$grouped_arr_key] as $grouped_arr_arr_key => $grouped_arr_arr_value)
                    $arr[] = $grouped_arr[$grouped_arr_key][$grouped_arr_arr_key];

        return $arr;
    }
    /*
    private function rad($d)
    {
        return $d * 3.1415926535898 / 180.0;
    }
    */
    /*
    public function get_distance($lat1, $lng1, $lat2, $lng2)
    {
        $EARTH_RADIUS = 6378.137;
        $radLat1 = $this->rad($lat1);
        //echo $radLat1;   
        $radLat2 = $this->rad($lat2);
        $a = $radLat1 - $radLat2;
        $b = $this->rad($lng1) - $this->rad($lng2);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) +
                                cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * $EARTH_RADIUS;
        $s = round($s * 10000) / 10000;
        return $s;
    }
    */

    //讀取CSV資料的修正版本，可讀取utf-8
    /*
    function fgetcsv_utf8(&$handle, $length = null, $d = ",", $e = '"')
    {
        $d = preg_quote($d);
        $e = preg_quote($e);
        $_line = "";
        $eof = false;
        while ($eof != true)
        {
            $_line .= ( empty($length) ? fgets($handle) : fgets($handle, $length));
            $itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);
            if ($itemcnt % 2 == 0)
                $eof = true;
        }
        $_csv_line = preg_replace('/(?: |[ ])?$/', $d, trim($_line));

        $_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:’ . $e . $e . ‘[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';
        preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
        $_csv_data = $_csv_matches[1];
        for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++)
        {
            $_csv_data[$_csv_i] = preg_replace("/^" . $e . "(.*)" . $e . "$/s", "$1", $_csv_data[$_csv_i]);
            $_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);
            $_csv_data[$_csv_i] = iconv("big5", "UTF-8", $_csv_data[$_csv_i]);
        }
        return empty($_line) ? false : $_csv_data;
    }
    */

    //多點下載機制
    /*
    function dl_file_resume($file)
    {
        //检测文件是否存在 
        if (!is_file($file))
        {
            die("<b>404 File not found!</b>");
        }

        $len = filesize($file); //获取文件大小 
        $filename = basename($file); //获取文件名字 
        $file_extension = strtolower(substr(strrchr($filename, "."), 1)); //获取文件扩展名 
        //根据扩展名 指出输出浏览器格式 
        switch ($file_extension)
        {
            case "exe": $ctype = "application/octet-stream";
                break;
            case "zip": $ctype = "application/zip";
                break;
            case "mp3": $ctype = "audio/mpeg";
                break;
            case "mpg": $ctype = "video/mpeg";
                break;
            case "avi": $ctype = "video/x-msvideo";
                break;
            default: $ctype = "application/force-download";
        }

        //Begin writing headers 
        header("Cache-Control:");
        header("Cache-Control: public");

        //设置输出浏览器格式 
        header("Content-Type: $ctype");
        if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
        {//如果是IE浏览器 
            # workaround for IE filename bug with multiple periods / multiple dots in filename 
            # that adds square brackets to filename - eg. setup.abc.exe becomes setup[1].abc.exe 
            $iefilename = preg_replace('/\./', '%2e', $filename, substr_count($filename, '.') - 1);
            header("Content-Disposition: attachment; filename=\"$iefilename\"");
        }
        else
        {
            header("Content-Disposition: attachment; filename=\"$filename\"");
        }
        header("Accept-Ranges: bytes");

        $size = filesize($file);
        //如果有$_SERVER['HTTP_RANGE']参数 
        if (isset($_SERVER['HTTP_RANGE']))
        {
            /*   --------------------------- 
              Range头域 　　Range头域可以请求实体的一个或者多个子范围。例如， 　　表示头500个字节：bytes=0-499 　　表示第二个500字节：bytes=500-999 　　表示最后500个字节：bytes=-500 　　表示500字节以后的范围：bytes=500- 　　第一个和最后一个字节：bytes=0-0,-1 　　同时指定几个范围：bytes=500-600,601-999 　　但是服务器可以忽略此请求头，如果无条件GET包含Range请求头，响应会以状态码206（PartialContent）返回而不是以200 （OK）。
              --------------------------- * /
    
            // 断点后再次连接 $_SERVER['HTTP_RANGE'] 的值 bytes=4390912- 

            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
            //if yes, download missing part 
            str_replace($range, "-", $range); //这句干什么的呢。。。。 
            $size2 = $size - 1; //文件总字节数 
            $new_length = $size2 - $range; //获取下次下载的长度 
            header("HTTP/1.1 206 Partial Content");
            header("Content-Length: $new_length"); //输入总长 
            header("Content-Range: bytes $range$size2/$size"); //Content-Range: bytes 4908618-4988927/4988928   95%的时候 
        }
        else
        {//第一次连接 
            $size2 = $size - 1;
            header("Content-Range: bytes 0-$size2/$size"); //Content-Range: bytes 0-4988927/4988928 
            header("Content-Length: " . $size); //输出总长 
        }
        //打开文件 
        $fp = fopen("$file", "rb");
        //设置指针位置 
        fseek($fp, $range);
        //虚幻输出 
        while (!feof($fp))
        {
            //设置文件最长执行时间 
            set_time_limit(0);
            print(fread($fp, 1024 * 8)); //输出文件 
            flush(); //输出缓冲 
            ob_flush();
        }
        fclose($fp);
        exit;
    }
    */

    function HiiiirLog($log){   
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_URL,"http://log.hiiir.com/tracklog.php?Val=".$log);
        //curl_setopt ($ch,CURLOPT_SSLVERSION, 3);
        curl_exec ($ch);
        if(curl_errno($ch)){
            $Json['error'] = 'connection error';
            $resultcode = json_encode($Json);
        }
        //關閉Curl釋放記憶體
        curl_close($ch);
    }


    public function set_api_error_log($api_name, $file_name, $data){
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $log["ip"]=$_SERVER['HTTP_CLIENT_IP'];
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $log["ip"]=$_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $log["ip"]=$_SERVER['REMOTE_ADDR'];

        //取得當下時間
        $log["today"] = date('Y-m-d');
        $log["now"]   = date('Y-m-d H:i:s');

        //計算資料夾路徑
        $log["path"]     = ERROR_LOG."/".$log["today"]."/".$api_name."/";
        $log["file"]     = $file_name;
        $log["fullpath"] = $log["path"].$log["file"].".log";
        $log["detail"]   = $data;

        //排出資訊
        $log["data"] = $log["now"].", ".$log["ip"]." \n".$log["detail"];

        if(!is_dir($log["path"]))
            mkdir($log["path"], 0777, true);

        error_log($log["data"]."\n", 3, $log["fullpath"]);
        unset($log);
    }
}

?>