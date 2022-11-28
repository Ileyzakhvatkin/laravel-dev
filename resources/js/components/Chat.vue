<template>
    <div class="chat-prop">
        <h3>Чет проекта</h3>
        <div class="chat-messages">
            <p v-for="message in messages" :key="message" >{{ message }}</p>
        </div>
        <input type="text" name="massage" class="form-control" v-model="massage" placeholder="Сообщение...">
        <button class="btn btn-outline-primary btn-sm" @click.prevent="sendMassage">Отправить</button>
    </div>
</template>

<style>
    .chat-prop {
        display: block;
        position: fixed;
        bottom: 15px;
        right: 15px;
        width: 300px;
        height: 300px;
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

</style>

<script>
    export default {

        data() {
            return {
                messages: [],
                message: '',
            }
        },

        mounted() {
            Echo.private('chat')
                .here((users) => {
                    this.addMessage('В чате ' + users.length + ' участников');
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
        },

        methods: {
            sendMassage() {
                if (this.massage.length > 0 ) {
                    axios.post('/chat', { message: this.message })
                            .then(() => {
                                this.message = '';
                            })
                }
            },
            addMessage(message) {
                this.messages.push(message);
            },
        },
    }
</script>
