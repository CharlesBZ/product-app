<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

final class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_index')]
    public function index(ProductRepository $repository): Response
    {   
        // Fetch all products from the database
        return $this->render('product/index.html.twig', [
            'products' => $repository->findAll(),
        ]);
    }

    #[Route('/products/{id<\d+>}', name: 'product_show')]
    public function show(Product $product): Response
    {   
        // $product = $repository->find($id);
        // if (!$product) {
        //     throw $this->createNotFoundException('Product not found');
        // }

        // Fetch a single product by its ID
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }

    #[Route('/products/new', name: 'product_new')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {   
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $manager->persist($product);
            $manager->flush();

            return $this->redirectToRoute('product_show', [
                'id' => $product->getId()
            ]);
        }

        // Render the form to create a new product
        return $this->render('product/new.html.twig', [
            'form' => $form,
        ]);
    }
}
