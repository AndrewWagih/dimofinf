// For Firebase JS SDK v7.20.0 and later, measurementId is optional
// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyBm55XiBVioj6BE6f0CiJ_GSIDyN5ZiLsY",
    authDomain: "dimofinf-3dbf7.firebaseapp.com",
    databaseURL: "https://dimofinf-3dbf7.firebaseio.com",
    projectId: "dimofinf-3dbf7",
    storageBucket: "dimofinf-3dbf7.appspot.com",
    messagingSenderId: "1087996284517",
    appId: "1:1087996284517:web:4756992adea6d00024008c",
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

initFirebaseMessagingRegistration();
onPushing();

function onPushing() {
    messaging.onMessage(function(payload) {
        const data = payload.data;
        const noteTitle = payload.notification.title;

        const noteOptions = {
            icon: 'https://info.cegedim-healthcare.co.uk/hubfs/CHS_Tasks%20logo.png',
            body: payload.notification.description,
        };

        $(".no-notifications-alert").addClass('d-none');

        /** append notification **/
        $("#unread-notifications-container,#all-notifications-container").prepend(`
        <div class="d-flex flex-stack py-4 notification-item">
            <!--begin::Section-->
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-50px me-4">
                    <span class="symbol-label bg-light-${data['gcm.notification.icon_color']}">
                        <span class="svg-icon svg-icon-2x svg-icon-${data['gcm.notification.icon_color']}">
                                ${data['gcm.notification.alert_icon']}
                        </span>
                    </span>
                </div>
                <!--end::Symbol-->

                <!--begin::Title-->
                <div class="mb-0 me-2">
                    <a href="/dashboard/notifications/${data['gcm.notification.id']}/mark_as_read" class="fs-6 text-gray-800 text-hover-primary fw-bold">${data['gcm.notification.alert_title']}</a>
                    <div class="text-gray-400 fs-7">${data['gcm.notification.description']}</div>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Section-->

            <!--begin::Label-->
            <span class="badge badge-light fs-8">${data['gcm.notification.date']}</span>
            <!--end::Label-->
        </div>
        `);

        let counterSpan = $(".notifications-counter");
        let counter = parseInt(counterSpan.text());

        if (Number(counter))
            counterSpan.text(`${counter + 1 + 'unread'}`);
        else
            counterSpan.text(1 + 'unread');


        new Notification(noteTitle, noteOptions);

        showToast(data['gcm.notification.alert_title']);

        $('.bullet.bullet-dot').removeClass('d-none');
    });
}

function initFirebaseMessagingRegistration() {
    messaging
        .requestPermission()
        .then(function () {
            return messaging.getToken()
        })
        .then(function(token) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/dashboard/save-token',
                type: 'POST',
                data: {
                    token: token
                },
                dataType: 'JSON',
                success: function (response) {
                    console.log('Token saved successfully.');
                },
                error: function (err) {
                    console.log('User Chat Token Error'+ err);
                },
            });

        }).catch(function (err) {
        console.log('User Chat Token Error'+ err);
    });
}

/** Load more btn **/
$("#unread-load-more,#all-load-more").click(function (e) {
    e.preventDefault();
    let loadMoreBtn = $(this);
    var type = loadMoreBtn.attr('id');
    var currentNotificationsCount = loadMoreBtn.siblings().length;

    loadMoreBtn.attr('data-kt-indicator', 'on')

    $.ajax({
        type: 'get',
        url: `/dashboard/notifications/${type}/load-more/${currentNotificationsCount}`,
        success: function (res) {
            if(res.data.length == 0){
                loadMoreBtn.remove();

            }else{
                $.each(res.data, function (key, notification) {

                    loadMoreBtn.before(`
                        <div class="d-flex flex-stack py-4 notification-item">
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <!--begin::Title-->
                                <div class="mb-0 me-2">
                                    <a href="/dashboard/notifications/${notification.id}/mark_as_read" class="fs-6 text-gray-800 text-hover-primary fw-bold">${notification.title}</a>
                                    <div class="text-gray-400 fs-7">${notification.description}</div>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Section-->

                            <!--begin::Label-->
                            <span class="badge badge-light fs-8">${notification.created_at}</span>
                            <!--end::Label-->
                        </div>
                    `);
                });

                loadMoreBtn.attr('data-kt-indicator', 'off')
            }

        }
    });
});
