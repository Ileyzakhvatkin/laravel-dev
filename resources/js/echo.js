// console.log('echo test');
Echo
    .channel('hello-channel')
    .listen('SomethingHappens', (e) => {
        console.log('Ну работай уже');
        alert(e.whatHappens);
    })
