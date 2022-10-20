<?php 
class Api
{
    function refresh()
    {
        $ch = curl_init();

        curl_setopt_array($ch, [CURLOPT_URL => "https://api.coincap.io/v2/assets", CURLOPT_RETURNTRANSFER => true]);

        $response = curl_exec($ch);

        $response = json_decode($response, true);

        return $response;
    }
    function search($coinid)
    {
        $coinid = str_replace(" ","-",$coinid);
        $ch = curl_init();

        curl_setopt_array($ch,[CURLOPT_URL =>"https://api.coincap.io/v2/assets/".$coinid."", CURLOPT_RETURNTRANSFER => true]);

        $response = curl_exec($ch);

        $response = json_decode($response, true);

        return $response;
    }
}

?>