<?php

namespace App\Http\Livewire\Forms;

use App\Actions\IntToRoman;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use PhpOffice\PhpWord\TemplateProcessor;

class SkUsahaForm extends ModalComponent
{
    public Resident $resident;
    public $form = [
        'jenis-usaha'
    ];

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public function submit(IntToRoman $intToRoman)
    {
        $resident = $this->resident;
        Carbon::setLocale('id');
        $templateFile = 'template_sk-usaha.docx';
        $template = new TemplateProcessor(base_path('template/' . $templateFile));
        $template->setValues(array(
            'user-name' => strtoupper(Auth::user()->name),
            'user-position' => Auth::user()->position,
            'name' => strtoupper($resident->name),
            'job' => $resident->job,
            'pob' => $resident->pob,
            'dob' => Carbon::parse($resident->dob)->translatedFormat('d-m-Y'),
            'gender' => $resident->gender,
            'address' => $resident->address,
            'jenis-usaha' => $this->form['jenis-usaha'],
            'today' => Carbon::parse(now())->translatedFormat('d F Y'),
            'year' => Carbon::parse(now())->translatedFormat('Y'),
            'month-roman' => $intToRoman->convert(Carbon::parse(now())->translatedFormat('n')),
        ));

        $template->saveAs(storage_path('app/surat/' . $resident->nik . '_sk-usaha.docx'));

        return response()->download(storage_path('app/surat/' . $resident->nik . '_sk-usaha.docx'))->deleteFileAfterSend();
    }

    public function render()
    {
        return view('livewire.forms.sk-usaha-form');
    }
}
