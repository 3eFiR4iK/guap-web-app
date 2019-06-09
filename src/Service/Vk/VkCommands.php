<?php

namespace App\Service\Vk;

use App\Parser\RaspGuapParser;
use VK\Client\Enums\VKLanguage;
use VK\Client\VKApiClient;

class VkCommands
{

    private $vkApiClient;

    public function __construct()
    {
        $this->vkApiClient = new VKApiClient('5.83', VKLanguage::RUSSIAN);
    }

    public function getScheduleForToday()
    {
        $parser = new RaspGuapParser('9740', null, null);
        return "this method getScheduleForToday";
    }
}
