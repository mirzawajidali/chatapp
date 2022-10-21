<template>
    <div class="container">
        <modal-component></modal-component>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body header-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="logo">
                                <h1><i class="fas fa-comment"></i> Messenger</h1>
                            </div>
                            <div>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal" class="profile"><i class="fas fa-user"></i></a>
                            </div>
                        </div>
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
                                        <div class="search mb-3">
                                            <input type="search" class="form-control" placeholder="Search">
                                            <div class="line"></div>
                                        </div>
                                        <a href="javascript:void(0)" @click="getConversation(user.id)" class="user-link"
                                            v-for="user in users.all">
                                            <div class="card user-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <div>
                                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                                                class="user-img" alt="">
                                                        </div>
                                                        <div class="username">
                                                            <h4>{{ user.name }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 chat-area">
                                <!-- <div class="active_user">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div>
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                                            class="user-img" alt="">
                                        </div>
                                        <div class="active_username">
                                            <h4>User</h4>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="pt-5"></div>

                                    <div v-for="messages in users.messages" @click="deleteMessage">
                                    <div class="card mt-3 message-card">
                                        <!-- <div class="card-body"> -->
                                        <!-- <h5>{{ messages }}</h5> -->
                                        <div class="message-text">
                                            <p>{{ messages }}</p>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="create_at">
                                        <p class="time"><i class="fas fa-check"></i> 2 min ago <i
                                                class="far fa-clock"></i></p>
                                    </div>

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
import Spinner from 'vue-simple-spinner';
export default {
    data() {
        return {
            users: {
                all: [],
                dynamic_id: null,
                active: [],
                messages: [],
                reciever: null,
            },
            message: null,
        }
    },
    methods: {
        sendMessage() {
            // this.chat.messages.push(this.message);
            // console.log(this.users.dynamic_id);
            axios.post('/send/message', { message: this.message, user_id: this.users.dynamic_id }).then(function (response) {
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
            that.accessable = true;
            axios.post('/get/conversation', {
                id: id,
            })
                .then(function (response) {
                    that.users.messages = [];
                    if (response.data.message) {
                        response.data.message.forEach(element => {
                            that.users.messages.push(element.message);
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            that.users.dynamic_id = id;
        },

        getActiveUser(user) {
            axios.post('/get/active/user', {}).then(function (response) {
                user.active.push(response.data);
            }).catch(function (response) {
                console.log(response);
            });
        },
        deleteMessage() {
            this.$swal.fire({
                title: 'Are you sure?',
                showCancelButton: true,
                confirmButtonColor: '#90e0ef',
                cancelButtonColor: '#35495e',
                confirmButtonText: 'Delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        },
        pusherConection(to) {
            var pusher = new Pusher('6b5c625fde26fa276545', {
                cluster: 'ap2'
            });
            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                console.log(to.dynamic_id);
                console.log(data.user_id);
                if(to.dynamic_id = data.user_id){
                    to.accessable = true;
                    console.log('CONDITION TRUE');
                    to.messages.push(data.message);
                }else{
                    console.log('FALSE');
                }
            });
        }
    },
    mounted() {
        this.getUsers(this.users.all);
        this.pusherConection(this.users);
        this.getActiveUser(this.users);
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

.container {
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
    /* z-index: 0000; */
}

.user-link {
    text-decoration: none;
    color: #35495e;
}

.user-card {
    background-color: #fff;
}

.user-card:hover {
    background-color: #90e0ef;
    color: #fff;
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
    /* padding: 1px; */
    z-index: 0000;
}

.message-text {
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

.create_at {
    margin-left: 12px;
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

.line {
    height: 1px;
    background-color: #90e0ef;
}

.profile {
    text-decoration: none;
    color: #fff;
    margin-right: 12px;
}

.fa-user {
    font-size: 24px;
}

.logo {
    margin-right: 12px;
}

.username {
    margin-top: 12px;
    margin-left: 12px;
}

.active_username {
    margin-top: 12px;
    margin-left: 12px;
}

.active_user {
    position: fixed;
    z-index: 222222222;
    width: 50%;
    background-color: #fff;
    padding-bottom: 14px;
}
.swal2-popup{
    width: 19rem !important;
    height: 19rem !important;
}
.swal2-styled{
    border-radius: 5rem !important;
}
</style>
