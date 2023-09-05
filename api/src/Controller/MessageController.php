<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Ramsey\Uuid\Uuid;
use DateTimeImmutable;

class MessageController extends AbstractController
{
    private $messagesDir = __DIR__.'/../../messages/'; 

    /**
     * @Route("/api/message", name="create_message", methods={"POST"})
     */
    public function createMessage(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || empty($data['message'])) {
            //return new JsonResponse(['error' => 'Invalid JSON data'], 400);
        }

        $uuid = Uuid::uuid4()->toString();
        $createdAt = new DateTimeImmutable();
        $message = [
            'uuid' => $uuid,
            'message' => $data['message'],
            'created_at' => $createdAt->format('Y-m-d H:i:s')
        ];

        $messageFilePath = $this->messagesDir . $uuid . '.json';
        file_put_contents($messageFilePath, json_encode($message));

        return new JsonResponse(['uuid' => $uuid], 201);
    }

    /**
     * @Route("/api/messages", name="list_messages", methods={"GET"})
     */
    public function listMessages(Request $request)
    {
        $sortBy = $request->query->get('sort_by', 'created_at');
        $order = $request->query->get('order', 'asc');

        $messageFiles = glob($this->messagesDir . '*.json');
        $messages = [];

        foreach ($messageFiles as $messageFile) {
            $messageData = json_decode(file_get_contents($messageFile), true);
            $messages[] = $messageData;
        }

        if ($sortBy === 'uuid' || $sortBy === 'created_at') {
            usort($messages, function ($a, $b) use ($sortBy, $order) {
                $comparison = strcmp($a[$sortBy], $b[$sortBy]);
                return $order === 'asc' ? $comparison : -$comparison;
            });
        }

        return new JsonResponse($messages);
    }

    /**
     * @Route("/api/message/{uuid}", name="get_message", methods={"GET"})
     */
    public function getMessage($uuid)
    {
        $messageFilePath = $this->messagesDir . $uuid . '.json';

        if (file_exists($messageFilePath)) {
            $messageData = json_decode(file_get_contents($messageFilePath), true);
            return new JsonResponse($messageData);
        }

        return new JsonResponse(['error' => 'Message not found'], 404);
    }
}
