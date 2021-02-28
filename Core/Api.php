<?php

namespace Core;

abstract class Api
{
    public function getFromUrl($url)
    {
        $json = file_get_contents($url);
        return json_decode($json, true);
    }

    public function setResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

}