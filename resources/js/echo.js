// console.log('echo test');
Echo.channel('hello-channel')
    .listen('SomethingHappens', (e) => {
        alert(e.whatHappens);
    });

// Echo.private('App.Models.User.1')
//     .notification((notification) => {
//         console.log(notification.subject);
//         alert(notification.subject);
//     });
