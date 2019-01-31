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
    public function getDetailsApi( string $title)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://www.omdbapi.com/?t='.$title.'&apikey=54fcec65');

        return $data = json_decode($res->getBody(), true);

    }
    public function getDetailsbyId(string $id)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://www.omdbapi.com/?i='.$id.'&apikey=54fcec65');

        return $data = json_decode($res->getBody(), true);
    }

}