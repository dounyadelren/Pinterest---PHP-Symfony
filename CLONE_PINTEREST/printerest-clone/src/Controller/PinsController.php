<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PinsController extends AbstractController
{

    #[Route('/', name:"app_home")]

    public function index(PinRepository $repo): Response
    {
        $pins = $repo->findBy([], ['createdAt' => 'DESC']);
        return $this->render('pins/index.html.twig', compact('pins'));
    }

    #[Route('/pins/{id<[0-9]+>}', name:"app_pins_show")]

    public function show(Pin $pin) : Response
    {
        return $this->render('pins/show.html.twig', compact('pin'));
    }


    #[Route('/pins/new', name:"app_pins_create")]
    

    public function create(Request $request, EntityManagerInterface $em){
        //manière symfony de faire 
        $pin = new Pin;
        $form = $this->createFormBuilder($pin)
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image (JPG or PNG file)',
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Télécharger',
                'download_uri' => true,
                'image_uri'=> true,
                'asset_helper' => true,
                'imagine_pattern' => 'squared_thumbnail_small',
                'attr' => [
                    'class' => 'm-3 btn btn-warning rounded',
                ]
            ])
            ->add('title', TextType::class, [
                // 'required' => true, 
                'label' => false,
                'attr' =>[ 
                    'class' => 'm-3',
                    'placeholder' => ' title',
                    ]
                ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' =>[
                    'class' => 'm-3',
                    'rows' => 10, 'cols' => 50
                    ]
                ])
            // ->add('submit', SubmitType::class, ['label' => 'Create Pin'])
            ->getForm()
            
            ;
        $user= $this->getUser();
        $pin->setUser($user);
        // dd($form);
        // dd($id);
        // dd($request);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $em->persist($id);
            $em->persist($pin);
            $em->flush();

            return $this->redirectToRoute('app_pins_show', ['id' => $pin->getId()]);

        // } else {
        //     echo 'erreur';
        }

        return $this->render('pins/new.html.twig', [
            'monFormulaire' => $form->createView()
        ]);
    }

    #[Route('/pins/{id<[0-9]+>}/edit', name:"app_pins_edit")]


    public function edit(Pin $pin, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder($pin)
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image (JPG or PNG file)',
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Télécharger',
                'download_uri' => true,
                'image_uri'=> true,
                'asset_helper' => true,
                'imagine_pattern' => 'squared_thumbnail_small',
                'attr' => [
                    'class' => 'm-3 btn btn-warning rounded',
                ]
            ])
            ->add('title', TextType::class, [
                'label' => false,
                // 'required' => true, 
                'attr' =>[ 
                    'class' => 'm-3',
                    'placeholder' => ' title']
                ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' =>[
                    'class' => 'm-3',
                    'rows' => 10, 'cols' => 50
                    ]
                ])
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_pins_show', ['id' => $pin->getId()]);

        }
        

        return $this->render('pins/edit.html.twig', ['pin' => $pin,  'form' => $form->createView()]); 
    }

    #[Route('/pins/{id<[0-9]+>}/delete', name:"app_pins_delete")]

    public function delete(Pin $pin, EntityManagerInterface $em ) : Response
    {
        $em->remove($pin);
        $em->flush();

        return $this->redirectToRoute('app_home');


    }
}
