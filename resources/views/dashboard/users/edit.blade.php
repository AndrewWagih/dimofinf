@extends('partials.dashboard.master')
@section('content')

    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a href="{{ route('dashboard.users.index') }}" class="text-muted text-hover-primary">User</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        edit new user
                    </li>
                    <!-- end   :: Item -->
                </ul>
                <!-- end   :: Breadcrumb -->

            </div>

        </div>

    </div>
    <!-- end   :: Subheader -->

    <div class="card">
        <!-- begin :: Card body -->
        <div class="card-body p-0">
            <!-- begin :: Form -->
            <form action="{{ route('dashboard.users.update',$user->id) }}" class="form" method="post" id="submitted-form" data-redirection-url="{{ route('dashboard.users.index') }}">
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">edit new user</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">


                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Username</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="username_inp" name="username" value="{{$user->username??''}}" placeholder="example"/>
                                <label for="username_inp">Enter the username</label>
                            </div>
                            <p class="invalid-feedback" id="username" ></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Phone</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="mobile_number_inp" name="mobile_number" value="{{$user->mobile_number??''}}" placeholder="example"/>
                                <label for="mobile_number_inp">Enter the mobile_number</label>
                            </div>
                            <p class="invalid-feedback" id="mobile_number" ></p>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Email</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="email_inp" name="email" value="{{$user->email??''}}" placeholder="example"/>
                                <label for="email_inp">Enter the email</label>
                            </div>
                            <p class="invalid-feedback" id="email" ></p>


                        </div>
                        <!-- end   :: Column -->


                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="col-lg-2 required fs-5 fw-bold mb-2  d-flex align-items-center">Password</label>

                            <div class="d-flex align-items-center form-floating">
                                <input type="password" class="form-control" id="password_field" name="password" placeholder="example" />
                                <a onclick="showHidePass( 'password_field' , $(this) )" style="cursor: pointer">
                                    <span class="fa fa-fw fa-eye fa-md toggle-password"   style="margin-left:-30px" ></span>
                                </a>
                            </div>
                            <p class="invalid-feedback" id="password" ></p>

                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Password confirmation</label>
                            <div class="d-flex align-items-center form-floating">
                                <input type="password" class="form-control" id="password_confirmation_field" name="password_confirmation" placeholder="example" />
                                <a onclick="showHidePass( 'password_confirmation_field' , $(this) )" style="cursor: pointer">
                                    <span class="fa fa-fw fa-eye fa-md toggle-password"   style="margin-left:-30px"></span>
                                </a>
                            </div>
                            <p class="invalid-feedback" id="password_confirmation" ></p>

                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->



                </div>
                <!-- end   :: Inputs wrapper -->

                <!-- begin :: Form footer -->
                <div class="form-footer">

                    <!-- begin :: Submit btn -->
                    <button type="submit" class="btn btn-primary" id="submit-btn">

                        <span class="indicator-label">Save</span>

                        <!-- begin :: Indicator -->
                        <span class="indicator-progress">Please wait ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!-- end   :: Indicator -->

                    </button>
                    <!-- end   :: Submit btn -->

                </div>
                <!-- end   :: Form footer -->
            </form>
            <!-- end   :: Form -->
        </div>
        <!-- end   :: Card body -->
    </div>

@endsection
