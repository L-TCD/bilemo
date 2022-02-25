<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ApiProductController extends AbstractController
{
    /**
     * @Route("/api/product", name="api_product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->json($productRepository->findAll(), 200, [], ['groups' => 'product:read']);
    }

    /**
     * @Route("/api/product", name="api_product_store", methods={"POST"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        try{
            $jsonReceived = $request->getContent();

            $product = $serializer->deserialize($jsonReceived, Product::class, 'json');

            $errors = $validator->validate($product);

            if(count($errors) > 0) {
                return $this->json($errors, 400);
            }
    
            $em->persist($product);
            $em->flush();
    
            return $this->json($product, 201, [], ['groups' => 'product:read']);

        } catch(NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }

    }
}
