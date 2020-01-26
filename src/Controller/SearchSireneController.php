<?php

namespace App\Controller;

use App\Form\SearchSireneType;
use App\Services\SearchSirene;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchSireneController extends AbstractController
{
    /**
     * @Route("/search/siren", name="search_siren")
     */
    public function search(Request $request, SearchSirene $searchSirene)
    {
        $result = '';
        $searchSirenForm = $this->createForm(SearchSireneType::class);

        $searchSirenForm->handleRequest($request);

        if ($searchSirenForm->isSubmitted() && $searchSirenForm->isValid()) {
            $result = $searchSirene->getContents($searchSirenForm->getData());
        }

        return $this->render('search_sirene/search.html.twig', [
            'searchSirenForm' => $searchSirenForm->createView(),
            'result' => $result,
        ]);
    }
}
