<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpecialDealController extends AbstractController
{
    /**
     * @Route("/", name="special_deal")
     */
    public function specialDeal(Request $request): Response
    {

        if ($product = $request->get('add-product')) {
        }

        return $this->render('special_deal/index.html.twig', []);
    }
}
