 @extends('backend.layouts.master')
 @section('content')
     <!-- [ breadcrumb ] start -->
     <div class="page-header">
         <div class="page-block">
             <div class="row align-items-center">
                 <div class="col-md-12">
                     <div class="page-header-title">
                         <h5 class="m-b-10">Dashboard</h5>
                     </div>
                     <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa-solid fa-house"></i></a>
                        </li>
                         <li class="breadcrumb-item"><a href="">Home</a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
     <!-- [ breadcrumb ] end -->
     <!-- [ Main Content ] start -->

     <!-- [ Main Content ] end -->
 @endsection
