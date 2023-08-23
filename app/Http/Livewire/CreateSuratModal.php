<?php

namespace App\Http\Livewire;

use App\Models\Resident;
use App\Services\SuratTemplateService;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateSuratModal extends ModalComponent
{
    public Resident $resident;
    public $templateList;

    public function mount(SuratTemplateService $service)
    {
        $this->templateList = $service->get();
    }

    public function render()
    {
        return view('livewire.create-surat-modal');
    }
}
