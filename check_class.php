<?php

require 'vendor/autoload.php';

use App\Models\Ad;

if (class_exists(Ad::class)) {
    echo "Class 'Ad' exists.\n";
} else {
    echo "Class 'Ad' not found.\n";
}