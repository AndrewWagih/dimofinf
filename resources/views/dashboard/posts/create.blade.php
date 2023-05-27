@extends('partials.dashboard.master')
@section('content')

    <!-- begin :: Subheader -->
    <div class="toolbar">

        <div class="container-fluid d-flex flex-stack">

            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                <!-- begin :: Title -->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><a href="{{ route('dashboard.posts.index') }}" class="text-muted text-hover-primary">Post</a></h1>
                <!-- end   :: Title -->

                <!-- begin :: Separator -->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!-- end   :: Separator -->

                <!-- begin :: Breadcrumb -->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!-- begin :: Item -->
                    <li class="breadcrumb-item text-muted">
                        add new post
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
            <form action="{{ route('dashboard.posts.store') }}" class="form" method="post" id="submitted-form" data-redirection-url="{{ route('dashboard.posts.index') }}">
                @csrf
                <!-- begin :: Card header -->
                <div class="card-header d-flex align-items-center">
                    <h3 class="fw-bolder text-dark">add new post</h3>
                </div>
                <!-- end   :: Card header -->

                <!-- begin :: Inputs wrapper -->
                <div class="inputs-wrapper">


                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row">

                            <label class="fs-5 fw-bold mb-2">Title</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title_inp" name="title" placeholder="example"/>
                                <label for="title_inp">Enter the title</label>
                            </div>
                            <p class="invalid-feedback" id="title" ></p>


                        </div>
                        <!-- end   :: Column -->

                        <!-- begin :: Column -->
                        <div class="col-md-12 fv-row">

                            <label class="fs-5 fw-bold mb-2">Description</label>
                            <div class="form-floating">
                                <textarea class="form-control" id="description_inp" name="description" style="height: 240px;" ></textarea>
                                <label for="description_inp">Enter the description</label>
                            </div>
                            <p class="invalid-feedback" id="description" ></p>


                        </div>
                        <!-- end   :: Column -->

                    </div>
                    <!-- end   :: Row -->

                    <!-- begin :: Row -->
                    <div class="row mb-8">

                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">Contact phone number</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_phone_number_inp" name="contact_phone_number" placeholder="example"/>
                                <label for="contact_phone_number_inp">Enter the contact phone number</label>
                            </div>
                            <p class="invalid-feedback" id="contact_phone_number" ></p>


                        </div>

                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">

                            <label class="fs-5 fw-bold mb-2">{{ __("User") }}</label>
                            <select class="form-select" data-control="select2" name="user_id" id="user-sp"  data-placeholder="{{ __("Choose the user") }}">
                                <option value="" selected ></option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"> {{ $user->username }} </option>
                                @endforeach
                            </select>
                            <p class="invalid-feedback" id="user_id" ></p>
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
