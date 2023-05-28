<style>
    .bullet-dot {
        width: fit-content;
        height: fit-content;
        border-radius: 100% !important;
        padding: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff !important;
        font-size: 10px;
        left: -10px !important;
        top: -5px !important;
    }
    .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--selected{
        background-image: unset !important;
    }
    .select2-container .select2-selection--single .select2-selection__clear{
        display: none;
    }
    div.dataTables_wrapper .table-responsive{
        min-height: 260px;
    }
    div.dataTables_wrapper div.dataTables_processing{
        transform: translateX(-50%) translateY(-50%);
    }
</style>


<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-1">
						<i class="fa fa-hamburger"></i>
                </span>
                <!--end::Svg Icon-->
            </div> 
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('dashboard.index') }}" class="d-lg-none">
                <img alt="Logo" src="{{asset('dashboard-assets/media/logos/logo-2.svg')}}" class="h-30px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                
            </div>
            <!--end::Navbar-->
            <!--begin::Toolbar wrapper-->
            <div class="d-flex align-items-stretch flex-shrink-0">

                <!--begin::User menu-->
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <div class="px-4">
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">Hello , {{ auth()->user()->name }}</small>
                    </div>
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="{{auth()->user()->image?getImagePath( auth()->user()->image , 'Employees'):asset('dashboard-assets/media/avatars/blank.png')}}" alt="user" />
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{auth()->user()->image?getImagePath( auth()->user()->image , 'Employees'):asset('dashboard-assets/media/avatars/blank.png')}}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5"> {{ auth()->user()->name }}</div>
                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7"> {{ auth()->user()->email }}</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                            <a href="#" class="menu-link px-5">
													<span class="menu-title position-relative">{{__("Language")}}
													<span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
													<img class="w-15px h-15px rounded-1 ms-2" src="{{asset('dashboard-assets/media/flags/united-states.svg')}}" alt="" /></span></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                
                                <div class="menu-item px-3">
                                    <a href="" class="menu-link d-flex px-5 ">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1" src="{{asset('dashboard-assets/media/flags/saudi-arabia.svg')}}" alt="" />
                                        </span> عربي
                                    </a>
                                </div>
                                
                                <div class="menu-item px-3">
                                    <a href="" class="menu-link d-flex px-5 ">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1" src="{{asset('dashboard-assets/media/flags/united-states.svg')}}" alt="" />
                                        </span> English
                                    </a>
                                </div>
                                
                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <div class="menu-content px-5">
                                <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="toggle-theme-mode">
                                    <input class="form-check-input w-30px h-20px" type="checkbox" name="mode" id="toggle-theme-mode"  />
                                    <span class="pulse-ring ms-n1"></span>
                                    <span class="form-check-label text-gray-600 fs-7">{{__("Dark Mode")}}</span>
                                </label>
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-5">
                            <div class="menu-content px-5">
                                <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="toggle-notifications">
                                    <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="toggle-notifications"  />
                                    <span class="pulse-ring ms-n1"></span>
                                    <span class="form-check-label text-gray-600 fs-7">{{__("Notifications")}}</span>
                                </label>
                            </div>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5 my-1">
                            <a href="" class="menu-link px-5">{{__("Account Settings")}}</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <form id="logout-form" method="post" action="#">
                                @csrf
                                <a href="javascript:" onclick="$('#logout-form').submit()" class="menu-link px-5">{{__("Sign Out")}}</a>
                            </form>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
                <!--begin::Notifications-->
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <!--begin::Menu- wrapper-->
                    <div class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                        <a href="javascript:" class="btn btn-icon btn-light pulse pulse-primary">
                            <i class="bi bi-bell-fill fs-1"></i>
                            <span class="pulse-ring border-2"></span>
                            <span class="bullet bullet-dot bg-danger position-absolute translate-end top-0 end-0 animation-blink">
                                <strong class="text-white" id="notification-count">{{$unreadNotifications->count()}}</strong>
                            </span>
                        </a>
                        <!--end::Svg Icon-->
                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{ asset('dashboard-assets/media/misc/pattern-1.jpg') }}')">
                            <!--begin::Title-->
                            <h3 class="text-white text-center fw-bold px-9 mt-10 mb-6 py-4">Notifications</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Tab content-->
                        
                        <div class="tab-content">
                            <div class="tab-pane fade @if( $unreadNotifications->count() == 0 ) show active @endif " id="no-notifications" role="tabpanel">
                                <!--begin::Wrapper-->
                                <div class="dnotifications/{id}/mark_as_read-flex flex-column px-9">
                                    <!--begin::Section-->
                                    <div class="pt-10 pb-0">
                                        
                                        <!--begin::Title-->
                                        <h3 class="text-dark text-center fw-bolder">No notifications</h3>
                                        <!--end::Title-->
                                        
                                        <!--begin::Text-->
                                        <div class="text-center text-gray-600 fw-bold pt-1">You'll see your notifications here once they come</div>
                                        <!--end::Text-->
                                        
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Illustration-->
                                    <div class="text-center px-4">
                                        <img class="mw-100 mh-200px" alt="image" src="{{ asset('dashboard-assets/media/illustrations/sketchy-1/1.png') }}" />
                                    </div>
                                    <!--end::Illustration-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                        </div>
                        <div class="tab-content">
                            <!--begin::Tab panel-->
                            <div class="tab-pane fade @if( $unreadNotifications->count() > 0 ) show active @endif " id="notifications-tab" role="tabpanel">
                                <!--begin::Items-->
                                <div class="scroll-y mh-325px my-5 px-8" id="notifications-body" >
                                    @foreach( $unreadNotifications as $notification )
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack py-4" onclick="window.location.href='{{$notification->data['url']}}'">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Title-->
                                            <div class="mb-0 me-2">
                                                <a href="{{$notification->data['url']}}" class="fs-6 text-gray-800 text-hover-primary fw-bold">{{$notification->data['title']}}</a>
                                                <div class="text-gray-400 fs-7">{{$notification->data['description']}}</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Label-->
                                        <span class="badge badge-light fs-8">{{$notification->created_at->diffForHumans()}}</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    @endforeach
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab content-->
                       
                        
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Notifications-->
                <!--begin::Header menu toggle-->
                <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                        <span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="black" />
													<path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="black" />
												</svg>
											</span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Header menu toggle-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
@push('scripts')
    <script>
        var favIconCounter = {{ $unreadNotifications->count() }};
        var favicon;

        $(document).ready(function() {
        

            KTLayoutSearch.init();
        });

        $(document).ready(() => {

            $("#toggle-theme-mode").change( function () {

                let mode = $(this).prop('checked') ? 'dark' : 'light';

                window.location.replace(`/dashboard/change-theme-mode/${ mode }`)

            });

            $("#toggle-notifications").change(function () {

            });
        })
    </script>
@endpush
