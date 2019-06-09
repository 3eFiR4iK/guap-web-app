<?php

namespace App\Action\Api;

use App\Exception\InvalidDataInJson;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class FormHandler
{
    private $formFactory;
    private $requestStack;

    public function __construct(FormFactoryInterface $formFactory, RequestStack $requestStack)
    {

        $this->requestStack = $requestStack;
        $this->formFactory = $formFactory;
    }

    public function processForm(string $formClass, $data = null)
    {
        $content = $this->getSubmittedJsonPayload();

        $form = $this->formFactory
            ->create($formClass, $data, ['allow_extra_fields' => true]);

        $submittedData = $form
            ->submit($content)
            ->getData();

        if (!$form->isValid()) {
            throw new InvalidDataInJson($this->parseErrors($form));
        }

        return $submittedData;
    }

    public function processFilters(string $formClass, $data = null)
    {
        $content = $this->getQueryParameters();
        $form = $this->formFactory
            ->create($formClass, $data);

        $submittedData = $form
            ->submit($content)
            ->getData();

        if (!$form->isValid()) {
            throw new InvalidDataInJson($this->parseErrors($form));
        }

        return $submittedData;
    }

    public function getQueryParameters()
    {
        return $this->requestStack->getCurrentRequest()->query->all();
    }

    public function getSubmittedJsonPayload(): array
    {
        $payload = $this->requestStack->getCurrentRequest()->getContent();

        if (0 === mb_strlen($payload)) {
            return [];
        }

        $data = json_decode($payload, true);

        return $data;
    }

    private function parseErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface && $childErrors = $this->parseErrors($childForm)) {
                $errors[$childForm->getName()] = $childErrors;
            }
        }

        return $errors;
    }
}
