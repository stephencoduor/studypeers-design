importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js",
);
// For an optimal experience using Cloud Messaging, also add the Firebase SDK for Analytics.
importScripts(
    "https://www.gstatic.com/firebasejs/7.16.1/firebase-analytics.js",
);

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
    messagingSenderId: "183108033073",
    apiKey: "AIzaSyB0CRV6upj62fP6aLqyDWrUcSUTfU_cTYE",
    projectId: "studypeers-283617",
    appId: "1:183108033073:web:099d75981928c5aefe5310",
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    // Customize notification here
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/logo-mb.jpg",
    };

    $.ajax({
            url : '<?php echo base_url();?>account/getLatestNotification',
            type : 'post',
            data : {"token" : 1},
            dataType: "json",
            success:function(result) {
                $('#notification-ul').html(result.notification);
                $('#notification_count').html(result.count);
            }   
        })

    return self.registration.showNotification( 
        notificationTitle,
        notificationOptions,
    );
});
