<div>
    <div class="modal-header">
        <h5 class="modal-title">Add Reply As</h5>
            <div class="ml-2">
                <select class="form-control" wire:model="reply_as" style="height: 100%;">
                    <option value="staff">Staff ({{ Auth()->user()->name }})</option>
                    <option value="user">User ({{ $ticket->user->name }})</option>
                </select>
                @error('reply_as')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

    <form wire:submit.prevent="submit" class="w-100">
        
        <div style="padding: 23px 23px">
            
            <div>
                @if ($reply_as == 'staff')
                <div>
                    <p>Hi <b>{{ $ticket->user->name }}</b>,<br><br>This message is regarding the <b>Ticket #{{$ticket->id}} </b>raised by you.&nbsp;</p>
                </div>
                @endif
            </div>
           
            
            <div wire:ignore>
                <textarea wire:model="description"  id="description"></textarea>
            </div>
            @error('description')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
            
            
            <div>
                @if ($reply_as == 'staff')
                <div>
                    <p><b style="font-size: 1rem;"><br></b></p><p><b style="font-size: 1rem;">Best Regards,</b><br></p><p><span style="font-size: 1rem;"><span style="font-family: Arial;">{{Auth()->user()->name}}</span><br></span><span style="font-size: 1rem;">Computer Reflex Support Team<br></span><a href="tel:+917003373754" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 1rem;">+91 7003 373 754</a><span style="font-size: 1rem;">&nbsp;| </span><a href="mailto:contact@computerreflex.tk" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 1rem;">contact@computerreflex.tk</a></p>
                </div>
                @endif
            </div>



           
            <div class="mt-3">  {{-- Attachments Section --}}
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
            
        </div>


            
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Send <i class="far fa-paper-plane"></i></button>
        </div>
    </form>
</div>


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