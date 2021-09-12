<form wire:submit.prevent="submit" class="w-100">
    
    <div wire:ignore>
        <textarea id="description"></textarea>
    </div>

        <div class="container mt-3">
            <div class="w-100 mb-2">
                <div>
                    <span class="text-primary">Attachments ({{count($attachments)}})</span>
                </div>
                @foreach ($attachments as $key => $attachment)
                <div class="mt-1">
                <span>
                    <span class="text-danger mr-2 cursor-pointer" wire:click="removeAttachment('{{ $key }}')"><i class="fas fa-trash-alt"></i></span>
                    <a href="{{ $attachment->temporaryUrl() }}" target="_blank">{{ $attachment->getClientOriginalName() }}</a> 
                </span>
                </div>
                @endforeach
            </div>
            <div class="w-100 text-left mb-2">
                <input wire:model="attachments_input" type="file" class="d-none" multiple id="file_uploader" >
                <button type="button" class="btn btn-secondary btn-sm" onclick="clickEl('#file_uploader')">Add Attachmets &nbsp; 
                <span wire:loading wire:target="attachments_input" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
                @error('attachments')
                <div class="text-danger">
                {{ $message }}
                </div>
                @enderror
            </div>
        </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Send <i class="far fa-paper-plane"></i></button>
    </div>
</form>




@push('scripts')
<script>
  $(document).ready(function () {
    $('#description').summernote({
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'help']],
        ],
        height: 250,
        callbacks: {
          onBlur: function(contents, $editable) {
              @this.set('description', $('#description').summernote('code'));
          }
        }
    });
  });
</script>
@endpush
