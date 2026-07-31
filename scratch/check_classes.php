<?php

require __DIR__.'/../vendor/autoload.php';

$classes = [
    'Filament\Schemas\Components\Group',
    'Filament\Schemas\Components\Section',
    'Filament\Forms\Components\TextInput',
    'Filament\Forms\Components\Hidden',
    'Filament\Forms\Components\RichEditor',
    'Filament\Forms\Components\DateTimePicker',
    'Filament\Forms\Components\Toggle',
    'Filament\Forms\Components\FileUpload',
    'Filament\Schemas\Components\Utilities\Set',
];

foreach ($classes as $c) {
    echo $c.': '.(class_exists($c) ? 'OK' : 'NOT FOUND').PHP_EOL;
}
