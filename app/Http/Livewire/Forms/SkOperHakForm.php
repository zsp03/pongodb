<?php

namespace App\Http\Livewire\Forms;

use App\Actions\IntToRoman;
use App\Models\Resident;
use Carbon\Carbon;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use PhpOffice\PhpWord\TemplateProcessor;

class SkOperHakForm extends ModalComponent
{
    public Resident $resident;
    public $receiverId;
    public $form = [
        'sejak-tahun' => '',
        'lokasi-dusun' => '',
        'aset-tanah' => '',
        'fungsi-tanah' => '',
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

    public function submit(IntToRoman $intToRoman)
    {
        $resident = $this->resident;
        $receiver = Resident::find($this->receiverId);
        Carbon::setLocale('id');
        $templateFile = 'template_sk-operhak.docx';
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
            'receiver-name' => strtoupper($receiver->name),
            'receiver-nik' => $receiver->nik,
            'receiver-job' => $receiver->job,
            'receiver-gender' => $receiver->gender,
            'receiver-religion' => $receiver->religion,
            'receiver-pob' => $receiver->pob,
            'receiver-age' => Carbon::parse($receiver->dob)->age,
            'receiver-dob' => Carbon::parse($receiver->dob)->translatedFormat('d-m-Y'),
            'receiver-address' => $receiver->address,
            'month-roman' => $intToRoman->convert(Carbon::parse(now())->translatedFormat('n')),
            'today' => Carbon::parse(now())->translatedFormat('d F Y'),
            'year' => Carbon::parse(now())->translatedFormat('Y'),
            'aset-tanah' => $this->form['aset-tanah'],
            'sejak-tahun' => $this->form['sejak-tahun'],
            'lokasi-dusun' => $this->form['lokasi-dusun'],
            'fungsi-tanah' => $this->form['fungsi-tanah'],
            'batas-utara' => $this->form['batas-utara'],
            'batas-timur' => $this->form['batas-timur'],
            'batas-selatan' => $this->form['batas-selatan'],
            'batas-barat' => $this->form['batas-barat'],
            'saksi-pertama' => strtoupper($this->form['saksi-pertama']),
            'saksi-kedua' => strtoupper($this->form['saksi-kedua'])
        ));
        $template->saveAs(storage_path('app/surat/' . $resident->nik . '_sk-operhak.docx'));

        return response()->download(storage_path('app/surat/' . $resident->nik . '_sk-operhak.docx'))->deleteFileAfterSend();
    }

    public function render()
    {
        return view('livewire.forms.sk-oper-hak-form');
    }
}
