<?php

namespace App\Action\Api\V1\Vk;

use App\Action\Api\FormHandler;
use App\Form\Vk\VkTypeActionForm;
use App\Responder\VKResponder;
use App\Service\Vk\VkCommands;
use App\Service\Vk\VkService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;

class ExecuteCommandApiAction
{
    /**
     * @var VKResponder
     */
    private $vkResponder;

    /**
     * @var FormHandler
     */
    private $formHandler;

    /**
     * @var VKResponder
     */
    private $responder;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var VkCommands
     */
    private $vkCommands;

    private $vkService;

    public function __construct(
        VKResponder $vkResponder,
        FormHandler $formHandler,
        VKResponder $VKResponder,
        RouterInterface $router,
        VkService $vkService,
        VkCommands $vkCommands
    ) {
        $this->responder = $VKResponder;
        $this->formHandler = $formHandler;
        $this->vkResponder = $vkResponder;
        $this->router = $router;
        $this->vkService = $vkService;
        $this->vkCommands = $vkCommands;
    }

    /**
     * @Route("vk", name="api_v1_vk", methods={"POST"})
     */
    public function __invoke()
    {
        $data = $this->formHandler->processForm(VkTypeActionForm::class);

        switch ($data['type']) {
            case 'confirmation':
                return new RedirectResponse($this->router->generate('api_v1_vk_confirmation'));
                break;
            case 'message_new':
                $payload = $this->vkService->parsePayload($data['object']['payload']);
                dd($payload->getCommand());
                break;
        }
    }
}
