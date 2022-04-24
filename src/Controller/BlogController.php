<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use ContainerHNhvkhG\getKnpPaginatorService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;


class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog')]
    public function index(ArticleRepository $articleRepository, Request $request,  PaginatorInterface  $paginator): Response
    {
        // $paginator->paginate($articleRepository->findAll(),
        //     $request->query->getInt('page', 1)/*page number*/,
          
        //     10/*limit per page*/
        // );
        // dd(  $paginator->paginate(
        //         $articleRepository->findAll(),
        //         $request->query->getInt('page', 1)/*page number*/,
        //         10/*limit per page*/
        //     ) );
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'developer'=>'abdelrhman abdullah',
            'articles' =>       $paginator->paginate(
                $articleRepository->findAll(),
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            )
        ]);
    }

    #[Route('article/{article}',name:'article_show')]
    public function show(Article $article){
        // dd( $article);
        return  $this->render('blog/show.html.twig',['article'=>$article]);

    }


    #[Route('create/article', name: 'article_create')]
    public function create(Request $request, EntityManagerInterface $entityManger)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $entityManger->persist($article);
            $entityManger->flush();
            // dd($article->getId());
            // $this->redirect('article/'. $article->getId());
           return $this->redirectToRoute('article_show', ['article' => $article->getId()],301);
        }
        return  $this->render('blog/create.html.twig',['form'=>$form->createView()]);
    }

    // #[Route('store/article', name: 'article_store')]
    // public function store(Request $request, ObjectManager $entityManger)
    // {
    //     $article = new Article();
    //     $form = $this->createForm(ArticleType::class, $article);
    //     $form->handleRequest($request);
    //     if($form->isSubmitted() && $form->isValid()){
    //         $entityManger->persist($article);
    //         $entityManger->flush();
    //         dd($article);
    //         $this->redirectToRoute('article_show', ['article'=>$article->id]);
    //     }
    // }
}
