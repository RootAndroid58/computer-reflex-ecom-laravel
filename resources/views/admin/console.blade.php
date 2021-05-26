@extends('layouts.panel')

@section('content')
    <div class="container-fluid">
        <div class="account-details-container ">
            <div class="wishlist-basic-padding">
                <form action="{{route('admin-console-submit')}}" method="post"> @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">php artisan</span>
                        </div>
                        <input type="text" name="artisan" class="form-control" aria-describedby="basic-addon1">
                    </div>

                    @if (isset($output))
                    <code class="code-1">
                        {!! str_replace("\n", '<br />',  $output) !!}
                    </code>
                    @endif
                    

                </form>
            </div>
        </div>
    </div>
@endsection