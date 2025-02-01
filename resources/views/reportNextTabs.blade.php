@extends('layout')
@section('container')
<div class="row" style="padding-left:100px;padding-right:100px;">
    
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-12">
                            <a href="/wholesalesdetailsViseSummary">
                            <div class="card-box noradius noborder bg-lime-green">
                                <i class="fa fa-user-plus float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Daily Summary</h5>
                                <h5 class="m-b-20 text-white counter" id="h1_s">0</h5>
                                <span class="text-white">12 Today</span>
                            </div>
                            </a>
                        </div>
    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-12">
                              <a href="/wholesalesSummary">
                            <div class="card-box noradius noborder bg-purple">
                                <i class="fa fa-download float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Date Vise Summary</h5>
                                <h5 class="m-b-20 text-white counter"  id="h1_p">0</h5>
                                <span class="text-white">12 Today</span>
                            </div>
                            </a>
                        </div>
                         <div class="col-xs-12 col-md-6 col-lg-6 col-xl-12">
                               <a href="/wholesalesMonthlySummary">
                            <div class="card-box noradius noborder bg-danger">
                                <i class="fa fa-sign-in  fa-rotate-90 float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Monthly Summary</h5>
                                <h5 class="m-b-20 text-white counter" id="h1_sr">0</h5>
                                <span class="text-white">12 Today</span>
                            </div>
                            </a>
                        </div>

                    
                        

                        
 





                    </div>
@endsection