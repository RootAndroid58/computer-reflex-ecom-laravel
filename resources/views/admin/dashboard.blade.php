@extends('layouts.panel')

@section('nav-dashboard', 'active')
@section('title','Dashboard')

@section('css-js')

@endsection 

@section('content')

<div class="container-fluid"> <!--Container-Fluid Start-->

    <h3 class="text-dark">Dashboard</h3>

            <div class="row">

                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Date</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>{{ date('dS M, Y (D)') }}</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div> 
                    </div>
                </div>

                @canany(['Manage Orders', 'Admin'])
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-success py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Orders in Last 28 Days</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>
                                        {{App\Models\Order::whereNotIn('status', ['checkout_pending', 'payment_failed', 'payment_pending'])->count()}} Orders
                                    </span></div>
                                </div>
                                <div class="col-auto"><i class="fa fa-inr fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

                @canany(['User Management', 'Admin'])
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-dark py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Total Users</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>{{App\Models\User::count()}} Users</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

                @canany(['Manage Orders', 'Admin'])
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-warning py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Orders Not Shipped Yet</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>{{App\Models\Order::where('status', 'order_placed')->orwhere('status', 'order_packing')->orwhere('status', 'packing_completed')->orwhere('status', 'shipment_created')->count()}} Orders</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

            </div>
                

                <div class="row"> <!--Buttons Row Start-->

                    @canany(['Manage Orders', 'Admin'])
                    <div class="col-lg-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <a href="{{route('admin-manage-orders')}}" class="btn btn-dark btn-lg pt-3 pb-3"><b>MANAGE ORDERS</b></a>
                        </div>
                    </div>
                    @endcanany
                    
                    @canany(['Manage Products', 'Admin'])
                    <div class="col-lg-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <a href="{{route('admin-manage-products')}}" class="btn btn-dark btn-lg pt-3 pb-3"><b>MANAGE PRODUCTS</b></a>
                        </div>
                    </div>
                    @endcanany
                    
                    @canany(['Manage Orders', 'Admin'])
                    <div class="col-lg-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <a href="{{route('admin-user-management')}}" class="btn btn-dark btn-lg pt-3 pb-3"><b>USER MANAGEMENT</b></a>
                        </div>
                    </div>
                    @endcanany

                    @canany(['Support Staff', 'Admin'])
                    <div class="col-lg-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <a href="{{route('admin-support-tickets')}}" class="btn btn-dark btn-lg pt-3 pb-3"><b>TICKETS</b></a>
                        </div>
                    </div>
                    @endcanany


                </div> <!--Buttons Row End-->






</div> <!--Container-Fluid End--->


        
@endsection
