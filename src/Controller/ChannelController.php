<?php

namespace App\Controller;

use App\Entity\Channel;
use App\Entity\Message;
use App\Form\ChannelType;
use App\Form\MessageType;
use App\Repository\ChannelRepository;
use App\Repository\MessageRepository;
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

    #[Route('/{id}', name: 'show_channel', methods: ['GET', 'POST'])]
    public function show(
        Channel $channel, 
        MessageRepository $messageRepository,
        Request $request) : Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()) {
            $message->setChannel($channel);
            $this->entityManager->persist($message);
            $this->entityManager->flush();

            return $this->redirectToRoute('show_channel', ['id' => $channel->getId()], Response::HTTP_SEE_OTHER);
        }

        $messages = $messageRepository->findBy(['channel' => $channel], ['createdAt' => 'ASC']);
        return $this->render('chat/show.html.twig', [
            'channel' => $channel,
            'messages' => $messages,
        ]);
    }
}
