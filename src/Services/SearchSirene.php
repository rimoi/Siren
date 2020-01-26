<?php


namespace App\Services;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class SearchSirene
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getContents(array $data): string
    {
        if (!isset($data['siren']) || !$numSiren = (int) $data['siren']) {
            return "Le Numéro de SIRENE fourni doit être un entier non vide !";
        } else {
            /*
             * Ici nous allons similer le faite que l'appel provient d'un service externe à notre API(SIRENE)
             */
            $client = HttpClient::create();
            $url = $this->router->generate('api_sirenes_get_collection', ['siren' => $numSiren], UrlGeneratorInterface::ABSOLUTE_URL);
            $response = $client->request('GET', $url, ['headers' => ['accept' => 'application/json']]);

            return Response::HTTP_OK === $response->getStatusCode() && '[]' !== $response->getContent() ? $response->getContent() : "Numéro introuvable !";
        }
    }
}