<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" @click="is_show = !is_show">
                    Switch
                </button>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div v-if="is_show" class="card-header">
                        <label for="name">Name</label>
                        <input id="name" class="form-control mr-sm-2" type="text" v-model="info.name">
                        <label for="surname">Surname</label>
                        <input id="surname" class="form-control mr-sm-2" type="text" v-model="info.surname">
                        <label for="id_number">ID Number</label>
                        <input id="id_number" class="form-control mr-sm-2" type="text" v-model="info.id_number">
                        <a class="btn btn-secondary" @click.prevent="create()">Create</a>
                    </div>
                    <div v-else class="card-header">
                        <form>
                            <div class="dropdown">
                                <button :class="contact_info.id === '' ? 'btn btn-success dropdown-toggle alert' : 'btn btn-secondary dropdown-toggle'" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{contact_name}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a v-for="(value,index) in contacts" :key="index" class="dropdown-item" @click="selectContact(index, value.name + ' ' + value.surname)" required>{{value.name + ' ' + value.surname}}</a>
                                </div>
                            </div>
                            <label for="surname">Contact Number</label>
                            <input id="surname" class="form-control mr-sm-2" type="text" required v-model="contact_info.contact_number">
                            <label for="contact_number">Email Address</label>
                            <input id="contact_number" class="form-control mr-sm-2" type="text" required v-model="contact_info.email">
                            <button class="btn btn-secondary" :disabled="contact_info.id === '' ? true : false" @click.prevent="create()">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    export default {
        mounted() {
            this.getContacts();
        },  
        data(){
            return {
                info: {
                    name: '',
                    surname: '',
                    id_number: '',
                },
                contact_info: {
                    id: '',
                    email: '',
                    contact_number: ''
                },
                component_loaded: false,
                contacts: '',
                contact_name: 'Select Contact',
                is_show: true
            }
        },
        methods: {
            create(){
                let envelope = {};
                if (this.is_show === true) {
                    envelope = this.info;
                } else {
                    envelope = this.contact_info
                }
                axios.post('/contacts',{
                    info: envelope,
                    choice: this.is_show
                })
                .then( response => {
                    alert(response.data.status);
                })
            },
            selectContact(id,name){
                this.contact_name = name;
                this.contact_info.id = id;
            },
            getContacts(){
                axios.get('/contacts').then( response => {
                    this.contacts = response.data;
                })
            }
        }

    }
</script>
