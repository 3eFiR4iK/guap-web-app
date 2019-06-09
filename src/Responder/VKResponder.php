<?php

namespace App\Responder;

use App\Enum\VkKeyboards;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use VK\Client\VKApiClient;
use VK\Client\Enums\VKLanguage;

class VKResponder
{
    /**
     * @var VKApiClient
     */
    private $vkClient;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        $this->vkClient = new VKApiClient('5.83', VKLanguage::RUSSIAN);
    }

    public function sendMessage(?string $message, ?VkKeyboards $keyboard): Response
    {
        return new Response(
            (string) $message,
            Response::HTTP_OK
        );
    }

    public function sendKeyboard()
    {
    }
}
