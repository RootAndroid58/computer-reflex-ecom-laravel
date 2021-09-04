@if (isMobile())

    @include('mobile.support.raise-support-ticket')

{{ die }}
@endif

@extends('layouts.support-menu-layout')

@section('nav-raise-support-ticket', 'account-menu-item-active')

@section('title', 'Raise Support Ticket')

@section('right-menu-col')
<div class="right-account-container account-details-container ">
                
    @livewire('support.raise-ticket')

    

</div>
@endsection

@section('bottom-js')

@endsection