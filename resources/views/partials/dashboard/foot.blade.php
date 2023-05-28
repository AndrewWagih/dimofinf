
<script src="{{asset('dashboard-assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('dashboard-assets/js/scripts.bundle.js')}}"></script>
<script src="{{asset('dashboard-assets/global_scripts.js')}}"></script>

@stack('scripts')

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.2/howler.core.min.js"></script>--}}
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-analytics.js"></script>

<script src="{{asset('dashboard-assets/js/listen-to-firebase-notification.js')}}"></script>