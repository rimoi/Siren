<?php

namespace App\Controller;

use App\Form\SearchSireneType;
use App\Repository\SireneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SearchSireneController extends AbstractController
{
    /**
     * @Route("/search/siren", name="search_siren")
     */
    public function search(Request $request, SireneRepository $sireneRepository)
    {
        $result = '';
        $searchSirenForm = $this->createForm(SearchSireneType::class);

        $searchSirenForm->handleRequest($request);

        if ($searchSirenForm->isSubmitted() && $searchSirenForm->isValid() && isset($searchSirenForm->getData()['siren'])) {
            /*
             * Ici nous allons similer le faite que l'appel provient d'un service externe à notre API(SIRENE)
             */
            $client = HttpClient::create();
            $url = $this->generateUrl('api_sirenes_get_collection', ['siren' => $searchSirenForm->getData()['siren']], UrlGeneratorInterface::ABSOLUTE_URL);
            $response = $client->request('GET', $url, ['headers' => ['accept' => 'application/json']]);

            $result = 200 === $response->getStatusCode() && '[]' !== $response->getContent() ? $response->getContent() : "Numéro introuvable !";
        }

        return $this->render('search_sirene/search.html.twig', [
            'searchSirenForm' => $searchSirenForm->createView(),
            'result' => $result,
        ]);
    }
}
