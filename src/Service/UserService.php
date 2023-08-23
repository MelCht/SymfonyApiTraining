<?php

namespace App\Service;

class UserService
{
    public function calculateAge(\DateTimeInterface $dateOfBirth): int
    {
        $now = new \DateTime();
        $interval = $now->diff($dateOfBirth);
        return $interval->y;
    }
}
