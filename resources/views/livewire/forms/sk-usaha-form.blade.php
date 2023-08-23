<div class="p-6 flex flex-col gap-2">
    <div>
        <x-input-label for="jenis-usaha" :value="__('Jenis Usaha')" />
        <x-text-input wire:model.defer="form.jenis-usaha" type="text" class="mt-1 block w-full"  required autofocus />
    </div>

    <div class="mt-2 flex gap-2">
        <button class="btn btn-primary" wire:click="$emit('closeModal')">Kembali</button>
        <button class="btn btn-primary" wire:click="submit">Buat</button>
    </div>
</div>
