$files = Get-ChildItem -Path d:\Laravel-dev\web-stageofbalikpapan\app\Filament\Resources -Recurse -Filter *.php

foreach ($file in $files) {
    $bytes = [System.IO.File]::ReadAllBytes($file.FullName)
    if ($bytes.Length -ge 3 -and $bytes[0] -eq 0xEF -and $bytes[1] -eq 0xBB -and $bytes[2] -eq 0xBF) {
        $newBytes = new-object byte[] ($bytes.Length - 3)
        [System.Array]::Copy($bytes, 3, $newBytes, 0, $bytes.Length - 3)
        [System.IO.File]::WriteAllBytes($file.FullName, $newBytes)
    }
}
Write-Output "BOM removed"
