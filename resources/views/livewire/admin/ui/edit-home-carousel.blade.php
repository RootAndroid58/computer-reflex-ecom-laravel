<div>
    
    @if (Session::has('createSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{Session('createSuccess')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>
    @endif
    
    {{-- {{ dd(Request::segments()) }} --}}
    <form wire:submit.prevent="submit" method="post" class="mt-3 mb-3"> @csrf
        <div class="row">
            <div class="form-group col-6">
                <label for="section_title">Section Title (Header)</label>
                <input type="text" value="{{ $title }}"
                class="form-control @error('title') is-invalid @enderror" wire:model.lazy="title" id="section_title" placeholder="Section Title">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-6">
                <label for="section_caption">Section Caption</label>
                <input type="text" value="{{ $caption }}"
                class="form-control @error('caption') is-invalid @enderror" wire:model.lazy="caption" id="section_caption" placeholder="Section Caption">
                @error('caption')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <p>Products List (Add Products From Below Table)</p>
        <span class="text-danger">
            @error('product_ids')
                {{ $message }}
            @enderror
        </span>
        <div class="products-list-container" style="min-height: 245px;">
            @if (count($products) < 1)
                <div class="alert alert-secondary" role="alert">
                   <strong>Please add some products.</strong> 
                </div>
            @else
                <div class="w-100 d-flex" style="overflow-x: scroll;">
                    @foreach ($products as $product)
                        <div style="padding: 15px; width: 175px;" class="text-center">
                            <div style="height: 100px;" class="w-100 text-center">
                                <img class="w-100" src="{{ asset('storage/images/products/'.$product->images[0]->image) }}" style="max-height: 100%;">
                            </div>
                            <div class="line-limit-3 w-100 text-center">
                                {{ $product->product_name }}
                            </div>
                            <a href="{{ route('edit-product', $product->id) }}" target="_blank" class="btn btn-block btn-outline-dark btn-sm">Edit</a>
                            <button type="button" class="btn btn-block btn-danger btn-sm" wire:click="removeProduct('{{ $product->id }}')">Remove</button>
                        </div>
                    @endforeach
                </div>  
            @endif
        </div>
        

        
        

        <div class="w-100 text-right">
            <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
        
    </form>




    <!--Products Table Start-->
    <div wire:ignore>
        <table id="AdminProductsTable" class="table table-striped table-bordered w-100">
            <thead class="bg-dark text-white">
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 20%">Product Name</th>
                <th style="width: 15%">Brand</th>
                <th style="width: 10%">MRP</th>
                <th style="width: 10%">Price</th>
                <th style="width: 10%">Stock</th>
                <th style="width: 10%">Status</th>
                <th style="width: 20%">Action</th>
            </tr>
            </thead>
            <tbody>
    
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Brand</th>
                <th>MRP</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
    






</div>




@push('scripts')

<script>

    function addProduct(pid) {
        @this.call('addProduct', pid);
    }

    $('#AdminProductsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{route('ajax-datatable.AdminSliderProductsTable')}}"
        },
        columns: [
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'product_name',
                name: 'product_name',
            },
            {
                data: 'product_brand',
                name: 'product_brand',
            },
            {
                data: 'product_mrp_custom',
                name: 'product_mrp_custom',
            },
            {
                data: 'product_price_custom',
                name: 'product_price_custom',
            },
            {
                data: 'stock',
                name: 'stock',
            },
            {
                data: 'product_status',
                name: 'product_status',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
            },
        ]

        

    });
</script>
@endpush
