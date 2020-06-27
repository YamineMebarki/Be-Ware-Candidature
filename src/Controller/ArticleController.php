<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="articlesList")
     */
    public function index(ArticlesRepository $repo)
    {
        $articleList = $repo->findAll();
        return $this->render('article/index.html.twig',[
            'dataTable' => $articleList
        ]);
    }
}
