<?php

require __DIR__.'/../vendor/autoload.php';

$classes = [
    // Table Actions (WRONG - old namespace)
    'Filament\Tables\Actions\EditAction' => 'Tables\Actions\EditAction',
    'Filament\Tables\Actions\DeleteAction' => 'Tables\Actions\DeleteAction',
    'Filament\Tables\Actions\BulkActionGroup' => 'Tables\Actions\BulkActionGroup',
    'Filament\Tables\Actions\DeleteBulkAction' => 'Tables\Actions\DeleteBulkAction',

    // Actions (CORRECT - new namespace)
    'Filament\Actions\EditAction' => 'Actions\EditAction',
    'Filament\Actions\DeleteAction' => 'Actions\DeleteAction',
    'Filament\Actions\BulkActionGroup' => 'Actions\BulkActionGroup',
    'Filament\Actions\DeleteBulkAction' => 'Actions\DeleteBulkAction',

    // Columns
    'Filament\Tables\Columns\SpatieMediaLibraryImageColumn' => 'SpatieMediaLibraryImageColumn',
];

foreach ($classes as $fqcn => $label) {
    echo $fqcn.': '.(class_exists($fqcn) ? 'OK' : 'NOT FOUND').PHP_EOL;
}
