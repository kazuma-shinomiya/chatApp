<template>
    <div>
        <div class="card mb-3">
            <div v-for="message in messages">
                <div :class="isMyMessage(senderId, message)">
                    <h4>{{ message.content }}</h4>
                </div>
            </div>
        </div>
        <div class="text-center">
            <textarea placeholder="メッセージを入力" v-model="newMessage" ></textarea>
            <button @click="sendMessage">送信</button>
        </div>
        
    </div>
</template>

<script>
    export default {
        props: ['senderId', 'receiverId', 'endpoint'],
        data() {
            return {
                messages:[],
                newMessage: '',
                myMessage: 'card w-50 float-right text-secondary',
                yourMessage: 'card w-50 float-left',
            }
        },
        
        mounted() {
            axios.get(this.endpoint + '/fetch')
                .then(response => (this.messages = response.data));
            //LaravelEchoでpusherから受信したデータをmessages配列に追加
            console.log(window.Echo.channel('send-message.' + this.receiverId + this.senderId))
            window.Echo.channel('send-message.' + this.receiverId + this.senderId)
                        .listen('SendMessage', response => {
                            console.log(111111111);
                            this.messages.push(response.message);
                        });
        },
        methods: {
            sendMessage() {
                axios.post(this.endpoint + '/send', {
                    content: this.newMessage,
                    sender_id: this.senderId,
                    receiver_id: this.receiverId,
                })
                    .then(response => this.messages.push(response.data));
                this.newMessage = ''
            },
            
            //自分のメッセージかどうかの判定
            isMyMessage(senderId, message) {
                if (senderId === message.sender_id) {
                    return this.myMessage;
                } else {
                    return this.yourMessage;
                }
            }
        }    
    }
</script>