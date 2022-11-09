Echo
    .channel('hello-channel')
    .listen('SomethingHappens', (e) => {
        alert(e.whatHappens);
    })
