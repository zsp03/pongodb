<div class="p-6 flex flex-col gap-2">
    <div>
        <x-input-label for="batas-utara" :value="__('Pemilik')" />
        <x-text-input class="mt-1 block w-full input-disabled" value="{{ $resident->name }}" disabled/>
    </div>
    <div>
        <x-select
            label="Penerima"
            wire:model.defer="receiverId"
            placeholder="Cari penduduk"
            :async-data="route('api.residents.index')"
            option-label="name"
            option-value="id"
            option-description="nik"
        />
    </div>
    <div class="grid grid-cols-2 gap-2">
        <div>
            <x-input-label for="sejak-tahun" :value="__('Milik sejak tahun')" />
            <x-text-input wire:model.defer="form.sejak-tahun" type="number" class="mt-1 block w-full"  required autofocus   />
        </div>
        <div>
            <x-input-label for="aset-tanah" :value="__('Aset Tanah')" />
            <x-text-input wire:model.defer="form.aset-tanah" type="text" class="mt-1 block w-full"  required autofocus   />
        </div>
        <div>
            <x-select
                label="Lokasi Tanah"
                placeholder="Pilih Lokasi"
                :options="['BULO', 'MALAPA', 'TOREA', 'RURA BARU']"
                wire:model.defer="form.lokasi-dusun"
            />
        </div>
        <div>
            <x-input-label for="lokasi-dusun" :value="__('Fungsi Tanah')" />
            <x-text-input wire:model.defer="form.fungsi-tanah" type="text" class="mt-1 block w-full"  required autofocus   />
        </div>
        <div>
            <x-input-label for="batas-utara" :value="__('Batas Utara')" />
            <x-text-input wire:model.defer="form.batas-utara" type="text" class="mt-1 block w-full"  required autofocus   />
        </div>
        <div>
            <x-input-label for="batas-timur" :value="__('Batas Timur')" />
            <x-text-input wire:model.defer="form.batas-timur" type="text" class="mt-1 block w-full"  required autofocus   />
        </div>
        <div>
            <x-input-label for="batas-selatan" :value="__('Batas Selatan')" />
            <x-text-input wire:model.defer="form.batas-selatan" type="text" class="mt-1 block w-full"  required autofocus   />
        </div>
        <div>
            <x-input-label for="batas-barat" :value="__('Batas Barat')" />
            <x-text-input wire:model.defer="form.batas-barat" type="text" class="mt-1 block w-full"  required autofocus   />
        </div>
        <div>
            <x-input-label for="saksi-pertama" :value="__('Saksi 1')" />
            <x-text-input wire:model.defer="form.saksi-pertama" type="text" class="mt-1 block w-full uppercase"  required autofocus   />
        </div>
        <div>
            <x-input-label for="saksi-kedua" :value="__('Saksi 2')" />
            <x-text-input wire:model.defer="form.saksi-kedua" type="text" class="mt-1 block w-full uppercase"  required autofocus   />
        </div>
    </div>



    <div class="mt-2 flex gap-2">
        <button class="btn btn-primary" wire:click="$emit('closeModal')">Kembali</button>
        <button class="btn btn-primary" wire:click="submit">Buat</button>
    </div>
</div>
