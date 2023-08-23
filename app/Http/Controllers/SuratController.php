<?php

namespace App\Http\Controllers;

use App\Actions\IntToRoman;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class SuratController extends Controller
{
    public function export($nik, $type, IntToRoman $intToRoman)
    {
        $templateFile = 'template_' . $type . '.docx';
        Carbon::setLocale('id');
        $owner = Resident::where('nik', '=', $nik)->get()->first();
        $template = new TemplateProcessor(base_path('template/' . $templateFile));
        $template->setValues(array(
            'name' => strtoupper($owner->name),
            'nik' => $owner->nik,
            'job' => $owner->job,
            'gender' => $owner->gender,
            'religion' => $owner->religion,
            'pob' => $owner->pob,
            'age' => Carbon::parse($owner->dob)->age,
            'dob' => Carbon::parse($owner->dob)->translatedFormat('d-m-Y'),
            'address' => $owner->address,
            'today' => Carbon::parse(now())->translatedFormat('d F Y'),
            'year' => Carbon::parse(now())->translatedFormat('Y'),
            'month-roman' => $intToRoman->convert(Carbon::parse(now())->translatedFormat('n')),
        ));
        File::ensureDirectoryExists(storage_path('app/surat'));
        $template->saveAs(storage_path('app/surat/'.$nik.'_surat_' .$type. '.docx'));

        return response()->download(storage_path('app/surat/'.$nik.'_surat_' .$type. '.docx'))->deleteFileAfterSend();
    }
}
