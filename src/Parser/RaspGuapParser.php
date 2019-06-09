<?php

namespace App\Parser;

class RaspGuapParser extends Parser
{
    private $siteName = 'http://rasp.guap.ru/';

    private $group;

    private $day;

    private $teacher;

    public function __construct(
        ?string $group,
        ?string $teacher,
        ?string $day
    ) {
        $this->group = $group;
        $this->day = $day;
        $this->teacher = $teacher;
        $this->getGroupId('9740');
    }

    /**
     * @param string $groupName
     * @return mixed
     */
    private function getGroupId(string $groupName)
    {
        $crawler = $this->getSite($this->siteName.'?g=34');
        $groups = $crawler
            ->filterXPath('//select')
            ->first()
            ->children()
            ->extract(['value','_text']);

        $groups = array_filter($groups, function ($node) use ($groupName) {
            if ($groupName == $node[1]) {
                return $node;
            }
        });

        return array_shift($groups)[0];
    }

    public function getScheduleForGroup(?string $day)
    {

    }
}
