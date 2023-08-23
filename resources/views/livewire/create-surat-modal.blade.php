<div class="card bg-base-100 shadow-xl">
    <div class="card-body p-8">
        <h2 class="card-title">{{ ucwords($resident->name) }}</h2>
        <div class="flex flex-col gap-2">
            <span>{{ $resident->nik }}</span>
        </div>
        <div class="card-actions mt-2">
            @foreach($templateList as $template)
                @switch($template)
                    @case('sk-operhak')
                        <button class="btn btn-primary" wire:click="$emit('openModal', 'forms.sk-oper-hak-form', {{ json_encode(['resident' => $resident->id]) }})">
                            {{ $template }}
                        </button>
                        @break
                    @case('sk-usaha')
                        <button class="btn btn-primary" wire:click="$emit('openModal', 'forms.sk-usaha-form', {{ json_encode(['resident' => $resident->id]) }})">
                            {{ $template }}
                        </button>
                        @break
                    @default
                        <a href="{{ route('surat.export', [$resident->nik, $template]) }}" class="btn btn-primary">
                            {{ $template }}
                        </a>
                @endswitch
            @endforeach
        </div>
    </div>
</div>
