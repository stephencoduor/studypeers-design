<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>


<script>
        
        // Initialize Firebase
        // TODO: Replace with your project's customized code snippet
        var config = {
            'messagingSenderId': '183108033073',
            'apiKey': 'AIzaSyB0CRV6upj62fP6aLqyDWrUcSUTfU_cTYE',
            'projectId': 'studypeers-283617',
            'appId': '1:183108033073:web:099d75981928c5aefe5310',
        };
        firebase.initializeApp(config);

        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () {
                
                console.log("Notification permission granted.");
                
                // get the token in the form of promise
                return messaging.getToken()
            })
            .then(function(token) {
                $.ajax({
					url : '<?php echo base_url();?>account/saveFirebaseToken',
					type : 'post',
					data : {"token" : token},
					success:function(result) {
						console.log("token is : " + token);
					}	
				})
                
            })
            .catch(function (err) {
                
                console.log("Unable to get permission to notify.", err);
            });

        let enableForegroundNotification = true;
        messaging.onMessage(function(payload) {
            console.log("Message received. ", payload);
            
            // console.log(payload.data.notification);
            if(enableForegroundNotification) {
                const {title, ...options} = JSON.parse(payload.data.notification);
                navigator.serviceWorker.getRegistrations().then(registration => {
                    registration[0].showNotification(title, options);
                });

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
            }
        });
    </script>