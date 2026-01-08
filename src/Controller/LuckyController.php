<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;
//use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\String\u;


use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;



class LuckyController extends AbstractController
{
	#[Route('/lucky/number')]
	public function number(): Response
	{
		$number = random_int(0, 100);

		return new Response(
			'<html><body>Lucky number: '.$number.'</body></html>'
		);
	}

	#[Route('/qr', name: 'app_qr')]
    public function generate(): Response
    {
        $url = 'https://example.com';

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($url)
            ->size(300)
            ->margin(10)
            ->build();

        return new Response(
            $result->getString(),
            Response::HTTP_OK,
            ['Content-Type' => $result->getMimeType()]
        );
    }
}