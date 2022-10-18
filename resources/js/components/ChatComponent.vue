<template>
    <div class="container-fluid">
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
                                        <a href="" class="user-link">
                                            <div class="card user-card active">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-start align-items-center">
                                                        <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" class="user-img" width="10%" alt="" >
                                                        <h4>Wajid Ali</h4>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                        <a href="" class="user-link">
                                            <div class="card user-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-start align-items-center">
                                                        <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" class="user-img" width="10%" alt="" >
                                                        <h4>Wajid Ali</h4>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                        <a href="" class="user-link">
                                            <div class="card user-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-start align-items-center">
                                                        <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" class="user-img" width="10%" alt="" >
                                                        <h4>Wajid Ali</h4>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                        <a href="" class="user-link">
                                            <div class="card user-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-start align-items-center">
                                                        <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" class="user-img" width="10%" alt="" >
                                                        <h4>Wajid Ali</h4>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                        <a href="" class="user-link">
                                            <div class="card user-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-start align-items-center">
                                                        <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" class="user-img" width="10%" alt="" >
                                                        <h4>Wajid Ali</h4>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 chat-area" >
                                <div class="card mt-3 message-card" v-for="messages in chat.messages">
                                    <div class="card-body">
                                        <h5>{{ messages }}</h5>
                                        <span class="time"><i class="fas fa-check"></i> 2 min ago <i class="far fa-clock"></i></span>
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
                                    <input type="text" placeholder="Message here ..." v-model="message" id="message" class="form-control">
                                    <button type="submit" class="send-btn"><i class="fas fa-paper-plane send-icon"></i></button>
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
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                message: null,
                chat: {
                    messages: []
                }
            }
        },
        methods: {
            sendMessage(){
                this.chat.messages.push(this.message);
                this.message = '';
            }
        }
    }
</script>
<style scoped>
.header-card{
    background-color:  #85fdc7;
    color: #fff;
}
.card{
    background-color: #fff;
    border: 1px solid #fff;
}
.chat-area{
    background-color: rgb(250, 250, 250);
    height: 78vh;
    overflow-y: scroll;
}
.user-link{
    text-decoration: none;
    color: #35495e;
}
.user-card{
    background-color: #fff;
}
.active{
    background-color: #d7fdec;
}
.user-img{
    border-radius: 50px;
}
#usermenu{
    /* width: 83vh; */
    overflow-y: scroll;
}
.message-card{
    background-color: #35495e;
    color: #fff;
    border-radius: 15px;
}
.message-card-comming{
    background-color: #fff;
    color:  #35495e;
    border-radius: 15px;
}
.time{
    font-size: 12px;
}
.form-control{
    box-shadow: none;
    border: #fff;
    background-color: #fff;
    font-size: 18px;
}
.send-btn{
    border: none;
    background: none;
    color: #85fdc7;
    /* color: #fff; */
}
.send-icon{
    font-size: 18px;
    padding: 5px;
}
</style>
