$files = Get-ChildItem -Path d:\Laravel-dev\web-stageofbalikpapan\app\Filament\Resources -Recurse -Filter *.php

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    $modified = $false

    if ($content -match 'use Filament\\Schemas\\Schema;') {
        if ($file.Name -like '*Infolist.php') {
            $content = $content -replace 'use Filament\\Schemas\\Schema;', 'use Filament\Infolists\Infolist;'
            $content = $content -replace 'Schema \$schema', 'Infolist $infolist'
            $content = $content -replace 'return \$schema', 'return $infolist'
            $content = $content -replace '->components\(', '->schema('
        } elseif ($file.Name -like '*Form.php') {
            $content = $content -replace 'use Filament\\Schemas\\Schema;', 'use Filament\Forms\Form;'
            $content = $content -replace 'Schema \$schema', 'Form $form'
            $content = $content -replace 'return \$schema', 'return $form'
            $content = $content -replace '->components\(', '->schema('
        } elseif ($file.Name -like '*Resource.php') {
            $content = $content -replace 'use Filament\\Schemas\\Schema;', "use Filament\Forms\Form;`nuse Filament\Infolists\Infolist;"
            
            $content = $content -replace 'Schema \$schema\): Schema', 'Form $form): Form'
            
            # Replace form arguments
            $content = $content -replace 'PostForm::configure\(\$schema\)', 'PostForm::configure($form)'
            $content = $content -replace 'CategoryForm::configure\(\$schema\)', 'CategoryForm::configure($form)'
            $content = $content -replace 'AuthorForm::configure\(\$schema\)', 'AuthorForm::configure($form)'
            
            $content = $content -replace 'infolist\(Schema \$schema\)', 'infolist(Infolist $infolist)'
            $content = $content -replace 'PostInfolist::configure\(\$schema\)', 'PostInfolist::configure($infolist)'
            $content = $content -replace 'CategoryInfolist::configure\(\$schema\)', 'CategoryInfolist::configure($infolist)'
            $content = $content -replace 'AuthorInfolist::configure\(\$schema\)', 'AuthorInfolist::configure($infolist)'

            # For UserResource which doesn't use extracted Form classes
            if ($file.Name -eq 'UserResource.php') {
                $content = $content -replace 'return \$schema', 'return $form'
                $content = $content -replace '->components\(', '->schema('
            }
        }
        $modified = $true
    }
    
    if ($modified) {
        Set-Content -Path $file.FullName -Value $content -Encoding UTF8
    }
}
Write-Output "Done replacing"
