<div class="card shadow">
    <div class="card-header bg-dark text-white card-header-light">
        <h3 class="card-title">Client Box</h3>
    </div>
    <div class="card-body">
        <div class="d-flex mb-3">
            <div class="col-6">
                <select class="form-select rounded-0" wire:model="sourceLang">
                    <option value="" selected>Automatic detection</option>
                    @foreach ($lang_codes as $key => $lang)
                        <option value="{{ $key }}" {{ $sourceLang == $key ? 'selected' : '' }}>{{ $lang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select class="form-select rounded-0" wire:model="targetLang">
                    <option value="" disabled selected>Select a language</option>
                    @foreach ($lang_codes as $key=>$lang)
                        <option value="{{ $key }}">{{ $lang }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                <label class="form-label">Client Text</label>
                <textarea wire:model.debounce.500ms="clientText" type="text" class="form-control rounded-0 fs-1" style="resize: none"
                    placeholder="Type to translate." cols="30" rows="7"></textarea>
            </div>
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                <label class="form-label">Translated Client Text</label>
                <textarea wire:model="clientTranslatedText" cols="30" rows="7" readonly class="form-control fs-1 rounded-0 border-left-0"
                    style="resize: none;"></textarea>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        let typingTimer;
        let doneTypingInterval = 500;

        function clientDoneTyping() {
            Livewire.emit('clientTranslate');
        }

        document.addEventListener('livewire:load', function() {
            Livewire.hook('afterDomUpdate', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(clientDoneTyping, clientDoneTypingInterval);
            });

            Livewire.on('clientStopTyping', function() {
                clearTimeout(typingTimer);
                clientDoneTyping();
            });
        });
    </script>
@endpush
