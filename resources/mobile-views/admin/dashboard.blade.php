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


                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-success py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Total Donations</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>₹ 20,000</span></div>
                                </div>
                                <div class="col-auto"><i class="fa fa-inr fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-dark py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Total Users</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>1</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-warning py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Pending Orders</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>28</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
                

                <div class="row"> <!--Buttons Row Start-->


                    <div class="col-lg-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <a href="#" class="btn btn-primary btn-lg pt-3 pb-3"><b>DONATIONS</b></a>
                        </div>
                    </div>


                    <div class="col-lg-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <a href="#" class="btn btn-primary btn-lg pt-3 pb-3"><b>USER MANAGEMENT</b></a>
                        </div>
                    </div>

                
                    <div class="col-lg-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <a href="#" class="btn btn-primary btn-lg pt-3 pb-3"><b>TICKETS</b></a>
                        </div>
                    </div>


                    <div class="col-lg-6 mb-4">
                        <div class="card text-white bg-primary shadow">
                            <a href="#" class="btn btn-primary btn-lg pt-3 pb-3"><b>SEND EMAIL</b></a>
                        </div>
                    </div>

                </div> <!--Buttons Row End-->






</div> <!--Container-Fluid End--->


        
@endsection
