<?php

namespace Blog\Services;

class DateFormatter
{
    public function formatDate(string $date): string
    {
        if ($date == date("Y-m-d")) {
            return "Today";
        }

        return date("d.m.Y",strtotime($date));
    }
}
