<?php

namespace App\Controller;

use App\Form\SearchSireneType;
use App\Repository\SireneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchSireneController extends AbstractController
{
    /**
     * @Route("/search/siren", name="search_siren")
     */
    public function search(Request $request, SireneRepository $sireneRepository)
    {
        $result = [];
        $searchSirenForm = $this->createForm(SearchSireneType::class);

        $searchSirenForm->handleRequest($request);

        if ($searchSirenForm->isSubmitted() && $searchSirenForm->isValid() && isset($searchSirenForm->getData()['siren'])) {
            if ($siren = $sireneRepository->findOneBySiren($searchSirenForm->getData()['siren'])) {
                $result = $this->json($siren,200);
            }
        }

        return $this->render('search_sirene/search.html.twig', [
            'searchSirenForm' => $searchSirenForm->createView(),
            'result' => $result,
        ]);
    }
}
