<?php

use App\Property_assigment;

function classAlert($property_id)
{
    $classAlert = Property_assigment::getAlert($property_id);
    return $classAlert;
}

function countCalls($property_id)
{
    $calls = Property_assigment::countCalls($property_id);
    return $calls;
}