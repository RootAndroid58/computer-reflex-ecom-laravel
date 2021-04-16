@extends('layouts.common')

@php
    $ProductMRPTotal = 0;
    $ProductPriceTotal = 0;
@endphp

@section('title', 'Compare')
    
@section('css-js')
    <style>
.tscroll {
  width: 100%;
  overflow-x: scroll;
  margin-bottom: 10px;
}

.tscroll table td:first-child {
    font-weight: 600;
    color: rgb(61, 61, 61);
    position: sticky;
    left: 0;
    background-color: rgb(190, 190, 190);
}

    </style>
@endsection

@section('content')

<div class="body-container">
    <div class="container-fluid">
        <div class="account-details-container">
            <div class="wishlist-basic-padding" style="padding: 10px 32px;">
                <div class="account-details-title" style="padding-bottom: 0px;">
                    <img src="{{ asset('/img/svg/gift-box.svg') }}" width="50" alt="" srcset="">
                    <span style="padding-right: 0;">Compare Products</span>
                </div>
            </div>

            <div class="account-menu-break"></div>

            
            <div class="wishlist-basic-padding" style="padding: 0px 0px;">
                <div class="tscroll">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr >
                                <td style="width: 5px;">Images</td>
                                @for ($i = 0; $i < $product_ids->count(); $i++)
                                <td class="item-cell-{{ $compare[$i]->product->id }}" style="text-align: center; width: 600px !important; "> 
                                    <img width="150" src="{{ asset('storage/images/products/'.$compare[$i]->product->images[0]->image) }}" alt="">
                                </td>
                                @endfor
                            </tr>

                            <tr>
                                <td>Name</td>
                                @for ($i = 0; $i < $product_ids->count(); $i++)
                                <td class="item-cell-{{ $compare[$i]->product->id }}">{{$compare[$i]->product->product_name}}</td>
                                @endfor
                            </tr>

                            <tr>
                                <td>Price</td>
                                @for ($i = 0; $i < $product_ids->count(); $i++)
                                <td class="item-cell-{{ $compare[$i]->product->id }}">{{$compare[$i]->product->product_price}}</td>
                                @endfor
                            </tr>
                            

                            <tr>
                                <td>Brand</td>
                                @for ($i = 0; $i < $product_ids->count(); $i++)
                                <td class="item-cell-{{ $compare[$i]->product->id }}">{{$compare[$i]->product->product_brand}}</td>
                                @endfor
                            </tr>
                            
                            @foreach ($specifications as $key => $item)
                            <tr>
                                <td>{{$item->specification_key}}</td>
                                @for ($i = 0; $i < $product_ids->count(); $i++)
                                    <td class="item-cell-{{ $compare[$i]->product->id }}">
                                        @foreach ($compare[$i]->product->specifications as $specs)
                                        {{-- {{dd($specs)}} --}}
                                            @if ($specs->specification_key == $item->specification_key)
                                                {{ $specs->specification_value }}
                                            @endif
                                        @endforeach
                                    </td>
                                @endfor
                            </tr>
                            @endforeach

                        
                            <tr>
                                <td></td>
                                @for ($i = 0; $i < $product_ids->count(); $i++)
                                <td class="item-cell-{{ $compare[$i]->product->id }}">
                                    <a href="{{ route('product-index',$compare[$i]->product->id) }}" class="btn btn-block btn-info">Buy Now</a>
                                    @php
                                       $cart = App\Models\Cart::where('user_id', Auth()->user()->id)->where('product_id', $compare[$i]->product->id)->first();
                                    @endphp
                                    <a onclick="ToggleCart({{$compare[$i]->product->id}})" class="cursor-pointer btn btn-block @if(isset($cart)) btn-warning @else btn-success @endif cart-btn-{{ $compare[$i]->product->id }}">@if(isset($cart)) Remove From Cart @else Add To Cart @endif</a>
                                    
                                    <a onclick="ToggleCompare({{$compare[$i]->product->id}})" class="cursor-pointer btn btn-block btn-danger">Remove</a>
                                </td>
                                @endfor
                            </tr>

                        </tbody>
                    </table>            
                </div>
            </div>
          
            <div class="account-menu-break"></div>

        </div>
            
       
        
    </div>
</div>

@endsection

@section('bottom-js')


<script>
function ToggleCompare(product_id) {

    $.ajax({
        url: "{{route('toggle-compare-btn')}}",
        method: 'POST',
        data: {
            'product_id' : product_id,
        },
        success: function (data) {
            if (data.status == 500) {
                $('.item-cell-'+product_id).fadeOut();
            }
            if (data.status == 500 || data.status == 200) {
                $(".bootstrap-growl").remove();
                $.bootstrapGrowl(data.msg, {
                    type: data.type,
                    offset: {from:"bottom", amount: 100},
                    align: 'center',
                    allow_dismis: true,
                    stack_spacing: 10,
                })
            }
        }
    })

}


function ToggleWishlist(product_id) {

$.ajax({
    url: "{{route('toggle-wishlist-btn')}}",
    method: 'POST',
    data: {
        'product_id' : product_id,
    },
    success: function (data) {

        if (data == 500) {
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Removed from wishlist.", {
                type: "danger",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        } else if(data == 200) {
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Added to wishlist.", {
                type: "success",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
        }
    }
})

}

function ToggleCart(product_id) {

    $.ajax({
    url: "{{route('toggle-cart-btn')}}",
    method: 'POST',
    data: {
        'product_id' : product_id,
    },
    success: function (data) {

        if (data == 200) {
            $('#CartCount').load("{{ route('cart') }} #CartCount")
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Added To Cart.", {
                type: "success",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
            $('.cart-btn-'+product_id).removeClass('btn-success').addClass('btn-warning').html('Remove From Cart')
        } else if(data == 500) {
            $('#CartCount').load("{{ route('cart') }} #CartCount")
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl("Removed From Cart.", {
                type: "danger",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
            $('.cart-btn-'+product_id).removeClass('btn-warning').addClass('btn-success').html('Add To Cart')
        }
    }
})

}

</script>

@endsection