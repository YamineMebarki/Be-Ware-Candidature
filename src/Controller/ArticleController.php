<?php

namespace App\Controller;

use App\Form\ArticlesFormType;
use App\Repository\ArticlesRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     *  @Route("/home/{id}", name="app_home_id")
     * @Route("/")
     */
    public function index(ArticlesRepository $repo, Request $request, Articles $article = null)
    {
        if ($article)
        {
            $data = $repo->findOneBy([
                'id' => $article->getId()
            ]);
             $this->json([
                'code' => 200,
                'message' => 'data trouver',
                'data' => $data
            ], 200);
            dump($data);
            $articleList = $repo->findAll();
            return $this->render('article/index.html.twig',[
                'dataTable' => $articleList,
                'data_article' => $data !== null,
                'data_id' => $data->getId(),
                'data_name' => $data->getName(),
                'data_price' => $data->getPrice(),
                'data_qte' => $data->getQte(),
                'data_description' => $data->getDescription(),
                'data_createdAt' => $data->getCreatedAt()
            ]);
        }else{
            $data = null;
        }
        $articleList = $repo->findAll();
        return $this->render('article/index.html.twig',[
            'dataTable' => $articleList,
            'data_article' => $data !== null,
            'data_id' => $data !== null,
            'data_name' => null,
            'data_price' => null,
            'data_qte' => null,
            'data_description' => null,
            'data_createdAt' => null
        ]);
    }

    /**
     * @Route("/home/{id}", name="app_id")
     */
    public function homeId(ArticlesRepository $repo, Request $request, Articles $article = null)
    {
        if ($article)
        {
            $data = $repo->findOneBy([
                'id' => $article->getId()
            ]);
           return $this->json([
                'code' => 200,
                'message' => 'data trouver',
                'data' => $data
            ], 200);
            dump($data);
        }else{
            $data = null;
        }
    }

    /**
     * @Route("article/create", name="app_create")
     * @Route("article/{id}/modify", name="app_modify")
     */
    public function createArticle(Request $request, Articles $article = null, ArticlesRepository $repo)
    {
        if (!$article)
        {
            $article = new Articles();
        }
        $form = $this->createForm(ArticlesFormType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('app_success');
        }
        return $this->render('article/create.html.twig', [
            'articlesForm' => $form->createView(),
            'modifyMode' => $article->getId() !== null
        ]);
    }

    /**
     * @Route("success_create", name="app_success")
     * @return Response
     */
    public function successCreate()
    {
        return $this->render('article/success_create.html.twig');
    }
}
