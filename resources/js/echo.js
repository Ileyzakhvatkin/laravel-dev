// console.log('echo test');
Echo
    .channel('hello-channel')
    .listen('SomethingHappens', (e) => {
        alert(e.whatHappens);
    })
