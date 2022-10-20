<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body header-card">
                        <h1><i class="fas fa-comment"></i> ChatApp</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4" id="usermenu">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="javascript:void(0)" @click="getConversation(user.id)" class="user-link"
                                            v-for="user in users.all">
                                            <div class="card user-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                                            class="user-img" alt="">
                                                        <h4>{{ user.name }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 chat-area">
                                <div class="card mt-3 message-card" v-for="messages in chat.messages">
                                    <!-- <div class="card-body"> -->
                                        <!-- <h5>{{ messages }}</h5> -->
                                        <div class="message-text">
                                            <p>{{ messages }}</p>
                                            <!-- <p class="time"><i class="fas fa-check"></i> 2 min ago <i
                                                class="far fa-clock"></i></p> -->
                                        </div>


                                    <!-- </div> -->
                                </div>
                                <!-- <div class="card mt-3 message-card-comming">
                                    <div class="card-body">
                                        <h5>Hey! I am fine</h5>
                                        <span class="time"><i class="fas fa-check"></i> 1 sec ago <i class="far fa-clock"></i></span>

                                    </div>
                                </div> -->
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <form @submit.prevent="sendMessage" class="d-flex">
                                    <input type="text" placeholder="Message here ..." v-model="message" id="message"
                                        class="form-control">
                                    <button type="submit" class="send-btn"><i
                                            class="fas fa-paper-plane send-icon"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            users: {
                all: [],
                dynamic_id: null,
                active: [],
            },
            message: null,
            chat: {
                messages: [],
            },
        }
    },
    methods: {
        sendMessage() {
            // this.chat.messages.push(this.message);
            // var that = this;
            axios.post('/send/message', { message: this.message, user_id: this.dynamic_id }).then(function (response) {
            }).catch(function (response) {
                console.log(response);
            });
            this.message = '';
        },
        getUsers(user) {
            axios.get('/users').then(function (response) {
                response.data.users.forEach(element => {
                    user.push(element);
                });
            })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getConversation(id) {
            let that = this;
            axios.post('/get/conversation', {
                id: id,
            })
                .then(function (response) {
                    that.chat.messages = [];
                    if (response.data.message) {
                        response.data.message.forEach(element => {
                            that.chat.messages.push(element.message);
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            that.dynamic_id = id;
        },

        getActiveUser(user){
            axios.post('/get/active/user',{}).then(function(response){
                user.active.push(response.data);
            }).catch(function(response){
                console.log(response);
            });
        },

        pusherConection(to) {
            var pusher = new Pusher('6b5c625fde26fa276545', {
                cluster: 'ap2'
            });
            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                console.log('pusher');
                console.log(data);
                console.log('pusher');
                to.messages.push(data.message);

            });
        }
    },
    mounted() {
        this.getUsers(this.users.all);
        this.pusherConection(this.chat);
        this.getActiveUser(this.users);
        // this.$toast.show(`Hey! I'm here`);
        this.$toast.success('Welcome Back!');

    },
    created() {
        console.log(this.users.active);
    }
}
</script>
<style scoped>
.header-card {
    background-color: #90e0ef;
    color: #fff;
}
.container{
    height: 70vh;
}

.card {
    background-color: #fff;
    border: 1px solid #fff;
}

.chat-area {
    background-color: rgb(255, 255, 255);
    height: 78vh;
    overflow-y: scroll;
}

.user-link {
    text-decoration: none;
    color: #35495e;
}

.user-card {
    background-color: #fff;
}

.active {
    background-color: #d7fdec;
}

.user-img {
    border-radius: 50px;
    width: 50px;
}

#usermenu {
    height: 78vh;
    overflow-y: scroll;
}

.message-card {
    background-color: #90e0ef;
    color: #fff;
    border-radius: 50px;
    justify-content: center;
    max-width: 350px;
    padding: 3px;
}
.message-text{
    margin-left: 25px;
    margin-top: 12px;
    font-size: 17px;
}

.message-card-comming {
    background-color: #fff;
    color: #35495e;
    border-radius: 15px;
    margin: auto;
    padding: 1px;
    width: 50px;
}

.time {
    font-size: 10px;
}

.form-control {
    box-shadow: none;
    border: #fff;
    background-color: #fff;
    font-size: 18px;
}

.send-btn {
    border: none;
    background: none;
    color: #85fdc7;
    /* color: #fff; */
}

.send-icon {
    font-size: 18px;
    padding: 5px;
}
</style>
