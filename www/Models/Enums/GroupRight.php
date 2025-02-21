<?php

namespace App\Models\Enums;
enum GroupRight: int
{
    case viewer = 0;
    case poster = 1;
    case owner = 2;
}