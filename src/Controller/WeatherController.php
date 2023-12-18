<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use App\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    public function __construct(private WeatherService $weatherService)
    {
    }

    #[Route('/', name: 'app_weather')]
    public function index(Request $request): Response
    {
        $city = new City();
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $weatherData = $this->weatherService->getDataByCity($city->getName());
            return $this->render('weather/index.html.twig', [
                'form' => $form,
                'city' => $city->getName(),
                'data' => $weatherData
            ]);
        }
        return $this->render('weather/index.html.twig', [
            'form' => $form
        ]);
    }
}
