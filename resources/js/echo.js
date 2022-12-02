// console.log('echo test');
Echo.channel('hello-channel')
    .listen('SomethingHappens', (e) => {
        alert(e.whatHappens);
    });

Echo.channel('AdminChannel')
    .notification((notification) => {
        console.log('Монипуляция со статьей');
        alert('Монипуляция со статьей');
    });
