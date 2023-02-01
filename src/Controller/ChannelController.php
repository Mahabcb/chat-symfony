<?php

namespace App\Controller;

use App\Entity\Channel;
use App\Form\ChannelType;
use App\Repository\ChannelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChannelController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'new_channel', methods: ['GET', 'POST'])]
    public function new(Request $request, ChannelRepository $channelRepository) : Response
    {
        $channels = $channelRepository->findAll();

        $channel = new Channel();
        $form = $this->createForm(ChannelType::class, $channel);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()) {
            $this->entityManager->persist($channel);
            $this->entityManager->flush();

            return $this->redirectToRoute('new_channel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chat/new.html.twig', [
            'form' => $form->createView(),
            'channels' => $channels,
        ]);
    }

    #[Route('/{id}', name: 'show_channel', methods: ['GET'])]
    public function show(Channel $channel) : Response
    {
        return $this->render('chat/show.html.twig', [
            'channel' => $channel,
        ]);
    }
}
