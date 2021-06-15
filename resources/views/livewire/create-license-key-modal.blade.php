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
                <div class="w-100">
                    <div class="form-group">
                    <label>New License Key</label>
                        <input wire:model.debounce.600ms="form.license_key" autocomplete="off" type="text" name="form.license_key" class="form-control @error('form.license_key') is-invalid @enderror " placeholder="License Key">
                        @error('form.license_key') 
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">CREATE</button>
            </div>
        </div>
    </form>
</div>
