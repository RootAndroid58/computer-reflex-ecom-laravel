<div class="modal-dialog" role="document">
    <form class="w-100" wire:submit.prevent="submit" action="{{ route('datatable-product-licenses-table.store') }}" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New License Key</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <form wire:submit.prevent="submit" class="w-100">
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
                        <div class="alert alert-info" role="alert">
                            <strong>Upload CSV file as provided in below Template file.</strong>
                        </div>
                        <div class="w-100 text-right">
                            <button class="btn btn-sm btn-dark">Download Template <i class="fas fa-download"></i></button>
                        </div>

                        <div class="input-group mb-3 mt-3">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" wire:modal="csv" id="csv" aria-describedby="inputGroupFileAddon01">
                              <label class="custom-file-label" for="csv">Choose file</label>
                            </div>
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
