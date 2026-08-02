<?php

require __DIR__.'/../vendor/autoload.php';

echo class_exists('Livewire\Attributes\Computed') ? 'EXISTS' : 'NOT FOUND';
echo PHP_EOL;
