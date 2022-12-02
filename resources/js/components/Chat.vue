<template>
    <div class="chat-prop">
        <h3>Чат проекта</h3>
        <div class="chat-messages">
            <p v-for="message in messages">{{ message }}</p>
        </div>
        <div class="notify">
            {{ notify }}
        </div>
        <input type="text" name="message" class="form-control" v-model="message" @keydown="whisperTyping" placeholder="Сообщение...">
        <button class="btn btn-outline-primary btn-sm" @click.prevent="sendMessage()">Отправить</button>
    </div>
</template>

<style>
    .chat-prop {
        display: block;
        position: fixed;
        bottom: 15px;
        right: 15px;
        width: 300px;
        height: 315px;
        padding: 10px;
        background-color: #ffffff;
        border-radius: 10px;
        border: 3px solid #f1f1f1;
        z-index: 10;
    }
    .chat-prop h3 {
        font-size: 20px;
    }
    .chat-prop .chat-messages {
        height: 150px;
        margin-bottom: 10px;
        overflow-y: scroll;
    }
    .chat-prop input {
        margin-bottom: 10px;
    }
    .notify {
        font-size: 12px;
        height: 20px;
    }

</style>

<script>
    export default {

        data() {
            return {
                messages: [],
                message: '',
                notify: '',
                channel: null,
            }
        },

        mounted() {
            this.channel = Echo.join('chat');

            this.channel.here((users) => {
                    this.addMessage('В чате  ' + users.length + ' участников');
                })
                .joining((user) => {
                    this.addMessage('Пользователь ' + user.name + ' присоединился');
                })
                .leaving((user) => {
                    this.addMessage('Пользователь ' + user.name + ' покинул чат');
                })
                .listen('ChatMessage', (data) => {
                    this.addMessage(data.user.name + ': ' + data.message);
                });

            this.channel.listenForWhisper('typing', (data) => {
                this.addNotify('Печатает ' + data.name);
                setTimeout(() => {
                    this.notify = '';
                }, 3000)
            })
        },

        methods: {
            sendMessage() {
                let message = this.message;
                this.message = '';
                this.addMessage('Я: ' + message);

                if (this.message.length > 0 ) {
                    axios
                        .post('/chat', { message: this.message } )
                        .then(() => { })
                }
            },

            addMessage(message) {
                this.messages.push(message);
            },

            addNotify(data) {
                this.notify = data;
            },

            whisperTyping() {
                this.channel.whisper('typing', {name: 'другой участник...'});
            }
        },
    }
</script>
