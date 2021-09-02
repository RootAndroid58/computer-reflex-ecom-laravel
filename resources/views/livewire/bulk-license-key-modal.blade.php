<div class="modal-dialog modal-lg" role="document">
    <form class="w-100" wire:submit.prevent="submit" action="{{ route('datatable-product-licenses-table.store') }}" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New License Key</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <form wire:submit.prevent="submit" class="w-100" >
                    
                    <div class="form-group">
                      <label for="upload_type">Upload Type</label>
                      <select class="form-control" id="uploadType" wire:model="form.upload_type" id="upload_type">
                        <option value="raw">Raw Paste</option>
                        <option value="csv">Spreadsheet Upload</option>
                      </select>
                    </div>


                    @if ($form['upload_type'] == 'raw')
                        <div class="alert alert-info" role="alert">
                            <strong>Paste all license keys in the below text field. All keys will be separated by " " (Blank Space)</strong>
                        </div>

                        <div class="form-group">
                          <label>License Keys</label>
                          <textarea class="form-control @error('form.license_keys') is-invalid @enderror" id="bulkKeysTextarea" wire:model.600ms="form.license_keys" rows="10" placeholder="Paste all license keys"></textarea>
                            <div class="invalid-feedback">
                                @error('form.license_keys')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    @elseif($form['upload_type'] == 'csv')
                        
                    <div class="w-100">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" wire:model="form.header" value="checked" >
                            File contains header row?
                          </label>
                        </div>
                    </div>
                       
                    
                    <div class="mt-3 mb-3">
                        <input type="file" wire:model="form.csv" style="height: unset;"  class="cursor-pointer form-control @error('form.csv') is-invalid @enderror " >
                        <div class="invalid-feedback">
                            @error('form.csv')
                            {{ $message }}
                            @enderror 
                        </div>
                    </div>


                    <div>
                        @if (is_array($parse_data))
                        <table class="table">
                            @foreach ($parse_data as $key => $parse)
                                @if ($key == 0 && $form['header'] == 'checked')
                                    <tr>
                                        @foreach ($parse as $item)
                                            <th>{{ $item }}</th>
                                        @endforeach
                                    </tr>
                                @else 
                                <tr>
                                    @foreach ($parse as $item)
                                        <td>{{ $item }}</td>
                                    @endforeach
                                </tr>
                                @endif
                            @endforeach
                         
                        </table>
                        @endif
                        
                    </div>

    
                         
                    @endif

                </form>
            </div>

            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Upload <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> </button>
            </div>
        </div>
    </form>
</div>
