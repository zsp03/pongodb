<?php

namespace App\Services;

class SuratTemplateService
{
    public function get(): bool|array
    {
        $dirList = scandir(base_path('template'));
        $filteredList = array_filter($dirList, function ($file) {
            return str_contains($file, 'template_');
        });

        $templateList = array_map(function ($file) {
            $file = str_replace('template_', '', $file);
            return str_replace('.docx', '', $file);
        }, $filteredList);

        return array_values($templateList);
    }
}
