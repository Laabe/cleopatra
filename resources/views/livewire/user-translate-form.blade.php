<div class="card mt-4 shadow">
    <div class="card-header card-header bg-dark text-white">
        <h3 class="card-title">Agent Box</h3>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <div class="col-6">
                <label class="form-label">Agent Text</label>
                <textarea wire:model.debounce.500ms="userText" type="text" class="fs-1 form-control rounded-0" style="resize: none;"
                    placeholder="Type to translate." cols="30" rows="7"></textarea>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-between align-items-start">
                    <label class="form-label">Translated Agent Text</label>
                    <a href="javascript:void(0)" class="text-decoration-none d-flex align-items-center"
                        onclick="copyToClipboard()">
                        <i class="ti ti-box-multiple fs-2"></i>Copy
                    </a>
                </div>
                <textarea wire:model="userTranslatedText" id="userTranslatedText" cols="30" rows="7" readonly
                    class="fs-1 form-control rounded-0" style="resize: none;"></textarea>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        let typingTimer;
        let userDoneTypingInterval = 500;

        function userDoneTyping() {
            Livewire.emit('userTranslate');
        }

        document.addEventListener('livewire:load', function() {
            Livewire.hook('afterDomUpdate', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(userDoneTyping, userDoneTypingInterval);
            });

            Livewire.on('userStopTyping', function() {
                clearTimeout(typingTimer);
                userDoneTyping();
            });
        });
    </script>
@endpush
