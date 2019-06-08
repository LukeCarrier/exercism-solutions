<?php

const GIGASECOND_SECS = 10**9;

function from(DateTime $date): DateTime
{
    $interval = new DateInterval(sprintf('PT%dS', GIGASECOND_SECS));
    $result = clone $date;
    return $result->add($interval);
}
