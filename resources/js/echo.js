// console.log('echo test');
Echo
    .channel('hello-channel')
    .listen('SomethingHappens', (e) => {
        alert(e.whatHappens);
    });

Echo
    .join('admin-channel')
    .notification((notification) => {
        console.log(notification.type);
        alert(notification.subject);
    });
