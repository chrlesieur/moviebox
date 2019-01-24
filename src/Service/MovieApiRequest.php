<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 15/01/19
 * Time: 15:49
 */

namespace App\Service;

use GuzzleHttp\Client;

class MovieApiRequest
{
    public function getDetailsApi($title)
    {
        $search = str_replace(' ','+', $title);
        $client = new Client();
        $res = $client->request('GET', 'http://www.omdbapi.com/?t='.$search.'apikey=54fcec65');

        return $data = json_decode($res->getBody(), true);

    }
}