// console.log('echo test');
Echo
    .channel('hello-channel')
    .listen('SomethingHappens', (e) => {
        alert(e.whatHappens);
    })

Echo
    .private('App.Models.User.' + userId)
    .notification((notification) => {
        console.log(notification.type);
    });
