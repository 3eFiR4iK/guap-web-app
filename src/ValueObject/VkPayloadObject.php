<?php

namespace App\ValueObject;

use App\Enum\VkKeyboards;
use App\Service\Vk\VkCommands;

class VkPayloadObject
{
    /**
     * @var VkKeyboards|null
     */
    private $keyboard;

    private $command;

    public function __construct(string $command, ?VkKeyboards $keyboard)
    {
        $this->command = $command;
        $this->keyboard = $keyboard;
    }

    /**
     * @return VkKeyboards|null
     */
    public function getKeyboard(): ?VkKeyboards
    {
        return $this->keyboard;
    }

    /**
     * @return object
     */
    public function getCommand()
    {
        $vkCommands = new VkCommands();
        return $vkCommands->{$this->command}();
    }
}
