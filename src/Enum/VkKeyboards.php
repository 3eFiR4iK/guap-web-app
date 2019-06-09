<?php

namespace App\Enum;

class VkKeyboards extends AbstractEnum
{
    const MAIN = [
        "one_time" => false,
        "buttons" => [
            [
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"getScheduleForToday\"}",
                        "label"=> "на сегодня"
                    ],
                    "color"=> "primary"
                ],
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"Schedule\GetScheduleForTomorrow\"}",
                        "label"=> "на завтра"
                    ],
                    "color"=> "primary"
                ],
            ],
            [
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"keyboard\": \"MENU\"}",
                        "label"=> "меню"
                    ],
                    "color"=> "negative"
                ],
            ],
        ],
    ];

    const DAY_OF_THE_WEEK = [
        "one_time" => false,
        "buttons" => [
            [
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"Schedule\GetScheduleForMonday\"}",
                        "label"=> "Понедельник"
                    ],
                    "color"=> "primary"
                ],
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"Schedule\GetScheduleForTuesday\"}",
                        "label"=> "Вторник"
                    ],
                    "color"=> "primary"
                ],
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"Schedule\GetScheduleForWednesday\"}",
                        "label"=> "Среда"
                    ],
                    "color"=> "primary"
                ],
            ],
            [
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"Schedule\GetScheduleForThursday\"}",
                        "label"=> "Четверг"
                    ],
                    "color"=> "primary"
                ],
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"Schedule\GetScheduleForFriday\"}",
                        "label"=> "Пятница"
                    ],
                    "color"=> "primary"
                ],
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"Schedule\GetScheduleForSaturday\"}",
                        "label"=> "Суббота"
                    ],
                    "color"=> "primary"
                ],
            ],
            [
                "action"=> [
                    "type"=> "text",
                    "payload"=> "{\"command\": \"Menu\BackMenu\"}",
                    "label"=> "Назад"
                ],
                "color"=> "negative"
            ],
        ],
    ];

    const MENU = [
        "one_time"=> false,
        "buttons"=> [
            [
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"UpdateGroup\"}",
                        "label"=> "сменить группу"
                    ],
                    "color"=> "positive"
                ],
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"keyboard\": \"DAY_OF_THE_WEEK\"}",
                        "label"=> "на день недели"
                    ],
                    "color"=> "primary"
                ],
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"FindTeacher\"}",
                        "label"=> "поиск препода"
                    ],
                    "color"=> "primary"
                ],
            ],
            [
                [
                    "action"=> [
                        "type"=> "text",
                        "payload"=> "{\"command\": \"Menu\BackMenu\"}",
                        "label"=> "назад"
                    ],
                    "color"=> "negative"
                ],
            ],
        ],
    ];
}
