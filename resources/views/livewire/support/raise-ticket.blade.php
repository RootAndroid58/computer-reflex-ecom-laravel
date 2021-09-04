<div>

    <div class="form-group">
      <label for="help_topic">Help Topic <font style="color: red;">*</font></label>
      <select wire:model="help_topic" class="form-control @error('help_topic') is-invalid @enderror" name="ticket_topic" id="help_topic" >
        <option value="General Query">General Query</option>
        <option value="Account Related">Account Related</option>
        <option value="Order Related">Order Related</option>
        <option value="Return/Refund">Return/Replace</option>
        <option value="Payment Related">Payment Related</option>
        <option value="Technical Problem">Technical Problem</option>
      </select>
      @error('help_topic')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>


    
    <div class="form-group">
      @if ($help_topic == 'Order Related' || $help_topic == 'Return/Refund')
          <label >Order ID: <font style="color: red;">*</font></label>
          <select wire:name="order_id" class="form-control @error('order_id') is-invalid @enderror" required>
            @foreach ($orders as $order)
              <option value="{{$order->id}}">#{{ $order->id }}</option>
            @endforeach
          </select>
          @error('order_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        @endif
    </div> 
   


    <div class="form-group " >
      <label class="text-dark">Explain your issue</label>
        <div wire:ignore>
          <textarea wire:model.lazy="description" required id="description" class="form-control @error('description') is-invalid @enderror" rows="7"></textarea>
        </div>

        @error('description')
        <div class="text-danger">
          {{ $message }}
        </div>
        @enderror
    </div>
  
    

    <div>
      <div class="w-100 mb-3">
          <div>
              <span class="text-primary">Attachments ({{count($attachments)}})</span>
          </div>
          @foreach ($attachments as $key => $attachment)
          <div>
              <a href="{{ $attachment->temporaryUrl() }}" target="_blank">{{ $attachment->getClientOriginalName() }}</a> 
          </div>
          @endforeach
      </div>
      
      
      <div class="w-100 text-left">
      
          <input wire:model="attachments" type="file" class="d-none" multiple id="file_uploader" >
          <button type="button" class="btn btn-secondary btn-sm" onclick="clickEl('#file_uploader')">Attachmets</button>
          @error('attachments')
          <div class="text-danger">
            {{ $message }}
          </div>
          @enderror
      </div>
      
      <div style="text-align: right;">
          <button wire:click="submit" class="btn btn-success">Submit Ticket</button>
      </div>
  </div>
    
</div>

@push('scripts')
<script>
  $(document).ready(function () {
    $('#description').summernote({
            height: 250,
            callbacks: {
              onChange: function(contents, $editable) {
                  @this.set('description', contents);
              }
            }
        });
  });

</script>
@endpush
