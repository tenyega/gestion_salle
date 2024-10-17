<?php

namespace App\Service;

use DateTime;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Time;

class HourCalculator
{
    /** 
     * Calculate the total hours between two DateTime objects.
     *
     * @param DateTime $startDateTime
     * @param DateTime $endDateTime
     * @return float Total hours between the two DateTime objects.
     */
    public function calculateTotalHours(string $startDate, string $endDate, string $startTime, string $endTime): float
    {
        // Combine date and time into DateTime objects
        $startDateTime = new DateTime($startDate . ' ' . $startTime);
        $endDateTime = new DateTime($endDate . ' ' . $endTime);

        // Calculate the difference
        $interval = $startDateTime->diff($endDateTime);

        // Convert the interval to hours
        $totalHours = $interval->h + ($interval->days * 24) + ($interval->i / 60); // Add minutes as a fraction of an hour

        return $totalHours;
    }
}
