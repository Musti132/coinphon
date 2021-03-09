<template>
    <div>
        <p v-if="isConnected">We're connected to the server!</p>
        <div v-for="(item, key) in socketMessage" :key="key">
            <p>{{ item.topOfBookData[0].bidPrice }} {{item.ticker}}</p>
        </div>
        
        <button @click="pingServer()">Ping Server</button>

        <input type="text" v-model="fields.seconds" required/>

        <button @click="updateTimer()">Update price interval</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isConnected: false,
            socketMessage: {},
            counter: 0,
            fields: {},
            timer: null,
        };
    },

    mounted(){
        //this.timer = setInterval(this.pingServer, 3000)
    },

    sockets: {
        connect() {
            // Fired when the socket connects.
            this.isConnected = true;
        },

        message(data) {
            //console.log(data);
        },

        disconnect() {
            this.isConnected = false;
        },

        // Fired when the server sends something on the "messageChannel" channel.
        messageChannel(data) {
            this.socketMessage = data;
            console.log(data);
        },
    },

    methods: {
        async updateTimer(){
            clearInterval(this.timer);
            this.timer = setInterval(await this.pingServer, this.fields.seconds);
        },
        async pingServer() {
            console.log(Math.ceil(Math.random()*10))
            // Send the "pingServer" event to the server.
            this.$socket.emit("pingServer", "PING!");
        },

    },
};
</script>

<style scoped>
p {
    color: black !important;
}

input{
    color: black !important;
}
</style>