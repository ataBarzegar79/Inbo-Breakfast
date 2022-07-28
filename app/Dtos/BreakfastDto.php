<?php

namespace App\Dtos;

class BreakfastDto
{
    /**
     * @param int $id  breakfast id
     * @param string $name   breakfast name
     * @param string $description  breakfast description
     * @param string $createdAt  breakfast creation time
     * @param array $users    DTO-users participate in breakfast
     * @param float|string $averageRate average rate that breakfast has gotten from users
     * @param RateDto|null $userRate    rate and comment each user has entered for breakfast (can be null if not rated )
     */
    public function __construct(
        public int      $id,
        public string   $name,
        public string   $description,
        public string   $createdAt,
        public array    $users,
        public float|string    $averageRate,
        public ?RateDto $userRate,
    )
    {
    }

}
