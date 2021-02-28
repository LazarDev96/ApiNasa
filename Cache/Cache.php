<?php

namespace Cache;

class Cache
{
    public static function storeInFile($fileName, $data)
    {
        $myfile = fopen(dirname(__DIR__) . "/files/" . $fileName, "w");
        $txt = json_encode($data);
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    public static function readFromFile($fileName)
    {
        $myfile = fopen(dirname(__DIR__) . "/files/" . $fileName, "r");
        $data = fread($myfile, filesize(dirname(__DIR__) . "/files/" . $fileName));
        fclose($myfile);

        return $data;
    }

    public static function checkFileExist($fileName)
    {
        if (file_exists(dirname(__DIR__) . "/files/" . $fileName))
        {
            return true;
        } else {
            return false;
        }
    }
}