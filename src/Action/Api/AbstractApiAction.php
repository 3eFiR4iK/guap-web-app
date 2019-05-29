<?php

namespace App\Action\Api;

use App\Exception\InvalidDataInFilters;
use App\Exception\InvalidDataInJson;
use App\Exception\InvalidJsonException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use function App\Helper\extractConstraintViolationListFormForm;

abstract class AbstractApiAction
{
    use ContainerAwareTrait;

    protected function serialize($data, array $context = [])
    {
        $serializer = $this->container->get('serializer');

        return $serializer->serialize($data, JsonEncoder::FORMAT, $context);
    }

    protected function processForm(string $formClass, $data = null, bool $clearMissing = true)
    {
        $content = $this->getSubmittedJsonPayload() + $this->getSubmittedFiles();

        $form = $this->container->get('form.factory')
            ->create($formClass, $data, ['allow_extra_fields' => true]);

        $submittedData = $form
            ->submit($content, $clearMissing)
            ->getData();

        if (!$form->isValid()) {
            throw new InvalidDataInJson(extractConstraintViolationListFormForm($form));
        }

        return $submittedData;
    }

    protected function processFilters(string $formClass, $data = null)
    {
        $content = $this->getQueryParameters();

        $form = $this->container->get('form.factory')
            ->create($formClass, $data, ['allow_extra_fields' => true]);

        $submittedData = $form
            ->submit($content)
            ->getData();

        if (!$form->isValid()) {
            throw new InvalidDataInFilters(extractConstraintViolationListFormForm($form));
        }

        return $submittedData;
    }

    private function getSubmittedJsonPayload(): array
    {
        $payload = $this->container->get('request_stack')->getCurrentRequest()->getContent();

        if (0 === mb_strlen($payload)) {
            return [];
        }

        $data = json_decode($payload, true);

        if (JSON_ERROR_NONE !== json_last_error() or !is_array($data)) {
            throw new InvalidJsonException();
        }

        return $data;
    }

    private function getSubmittedFiles(): array
    {
        return $this->container->get('request_stack')->getCurrentRequest()->files->all();
    }

    public function getQueryParameters(): array
    {
        return $this->container->get('request_stack')->getCurrentRequest()->query->all();
    }
}
