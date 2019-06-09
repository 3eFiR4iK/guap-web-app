<?php
namespace App\Service\Vk;

use App\ValueObject\VkPayloadObject;

class VkService
{
    public function parsePayload(string $payload)
    {
        $payload = json_decode($payload, true);

        return new VkPayloadObject($payload['command'], $payload['keyboard'] ?? null);
    }

    public function confirmation()
    {

    }
}
