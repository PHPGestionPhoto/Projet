<?php

namespace App\Models\Enums;
enum PhotoVisibility: int
{
    case private = 0;
    case group = 1;
    case public = 2;
}