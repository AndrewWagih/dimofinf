/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({

    apiKey: "AIzaSyBm55XiBVioj6BE6f0CiJ_GSIDyN5ZiLsY",
    authDomain: "dimofinf-3dbf7.firebaseapp.com",
    databaseURL: "https://dimofinf-3dbf7.firebaseio.com",
    projectId: "dimofinf-3dbf7",
    storageBucket: "dimofinf-3dbf7.appspot.com",
    messagingSenderId: "1087996284517",
    appId: "1:1087996284517:web:4756992adea6d00024008c",
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        // body: payload.data['cm.notification.description'],
        body: "BACKGROUND BODY",
        icon: 'https://info.cegedim-healthcare.co.uk/hubfs/CHS_Tasks%20logo.png',
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
