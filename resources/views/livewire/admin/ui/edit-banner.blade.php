<div>
    <div class="modal-body">
    @if (isset($banner))
        

        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <label class="input-group-text">Banner Type</label>
            </div>
            <select class=" form-control @error('bannerType') is-invalid @enderror" wire:model="bannerType">
            <option selected disabled>Choose...</option>
            <option value="imageOnly">Image Only</option>
            <option value="imageText">Image & Text</option>   
            </select>
            @error('bannerType') 
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="mb-0">Banner Name <font color="red">*</font></label>
            <input wire:model="bannerName" type="text"
            class="form-control @error('bannerName') is-invalid @enderror" aria-describedby="helpId" placeholder="">
            <small class="form-text text-muted">Just for future reference. (Not visible publicly)</small>
            @error('bannerName') 
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>



        <div class="input-group mb-2 form-check">
            <input wire:model="editImage" type="checkbox" id="editImage" class="form-check-input" >
            <label class="form-check-label cursor-pointer" for="editImage">Change Banner Image</label>
        </div>
        
        <div class="form-group">
            <input type="file" wire:model="bannerImage" style="height: unset;" class="form-control-file form-control @error('bannerImage') is-invalid @enderror" @if ($editImage == false) disabled @endif>
            @error('bannerImage') 
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>

        
        
        

        @if ($bannerType == 'imageText')
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                <label class="mb-0">Header <font color="red">*</font></label>
                <input wire:model="header" type="text"
                    class="form-control @error('header') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                    @error('header') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="col-6">
                <div class="form-group">
                <label class="mb-0">Header Line 2 <font color="red">*</font></label>
                <input wire:model="header2" type="text"
                    class="form-control @error('header2') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                    @error('header2') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="mb-0">Caption <font color="red">*</font></label>
            <input wire:model="caption" type="text"
            class="form-control @error('caption') is-invalid @enderror" aria-describedby="helpId" placeholder="">
            @error('caption') 
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        
        <div class="form-group">
            <label class="mb-0">Button Text <font color="red">*</font></label>
            <input wire:model="buttonText" type="text"
                class="form-control @error('buttonText') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                @error('buttonText') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
        </div>
        @endif

        <div class="form-group">
            <label class="mb-0">Button Link <font color="red">*</font></label>
            <input wire:model="buttonLink" type="text"
                class="form-control @error('buttonLink') is-invalid @enderror" aria-describedby="helpId" placeholder="">
                @error('buttonLink') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
        </div>

    @endif
    </div>  

    

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button wire:click="editBanner" type="button" class="btn btn-success" >Save Changes <i class="fad fa-save"></i></button>
    </div>
    
</div>