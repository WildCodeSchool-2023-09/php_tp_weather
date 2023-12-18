<?php

namespace App;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{
    private const API_KEY = 'b2e172c3117cd2249ace85deac41b978';
//    private HttpClientInterface $client;
//
//    public function __construct(HttpClientInterface $client)
//    {
//        $this->client = $client;
//    }
    public function __construct(private HttpClientInterface $client)
    {
    }

    public function getDataByCity(string $cityName): array
    {
        $query = 'https://api.openweathermap.org/data/2.5/weather?q='. $cityName .'&appid=' . self::API_KEY;
        $response = $this->client->request('GET', $query);
        return $response->toArray();
    }
}