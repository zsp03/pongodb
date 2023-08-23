<?php

namespace App\Http\Livewire\Forms;

use App\Models\Resident;
use Carbon\Carbon;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use PhpOffice\PhpWord\TemplateProcessor;

class SiPestaForm extends ModalComponent
{
    public Resident $resident;
    public $form = [
        'batas-utara' => '',
        'batas-timur' => '',
        'batas-selatan' => '',
        'batas-barat' => '',
        'saksi-pertama' => '',
        'saksi-kedua' => ''
    ];
    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public function submit()
    {
        $resident = $this->resident;
        Carbon::setLocale('id');
        $templateFile = 'template_si-pesta.docx';
        $template = new TemplateProcessor(base_path('template/' . $templateFile));
        $template->setValues(array(
            'name' => strtoupper($resident->name),
            'nik' => $resident->nik,
            'job' => $resident->job,
            'gender' => $resident->gender,
            'religion' => $resident->religion,
            'pob' => $resident->pob,
            'age' => Carbon::parse($resident->dob)->age,
            'dob' => Carbon::parse($resident->dob)->translatedFormat('d-m-Y'),
            'address' => $resident->address,
            'today' => Carbon::parse(now())->translatedFormat('d F Y'),
            'batas-utara' => $this->form['batas-utara'],
            'batas-timur' => $this->form['batas-timur'],
            'batas-selatan' => $this->form['batas-selatan'],
            'batas-barat' => $this->form['batas-barat'],
            'saksi-pertama' => $this->form['saksi-pertama'],
            'saksi-kedua' => $this->form['saksi-kedua']
        ));
        $template->saveAs(storage_path('app/surat/' . $resident->nik . '_sk-operhak.docx'));

        return response()->download(storage_path('app/surat/' . $resident->nik . '_sk-operhak.docx'))->deleteFileAfterSend();
    }

    public function render()
    {
        return view('livewire.forms.si-pesta-form');
    }
}
