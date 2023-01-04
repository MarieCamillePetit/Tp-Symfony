<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MeteoController extends AbstractController
{
    #[Route('/meteo')]
    public function number()
    {
        // $lat = $_POST['lat'];
        // $long = $_POST['long'];

        // $curl = curl_init("https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$long&hourly=temperature_2m");

        $curl = curl_init("https://api.open-meteo.com/v1/forecast?latitude=15&longitude=65&hourly=temperature_2m");


        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $data = curl_exec($curl);

        if ($data === false) {
            var_dump(curl_error($curl));
        }else{}

        $json = json_encode($data, true);
        $latitude = $json['latitude'];
        $longitude = $json['longitude'];

        curl_close($curl);

        return $this->render('meteo/meteo.html.twig', [
             'latitude' => $latitude,
             'longitude' => $longitude,
        ]);
    }
}
