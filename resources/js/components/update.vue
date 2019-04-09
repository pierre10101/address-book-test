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
                        <div class="dropdown">
                            <button :class="id === '' ? 'btn btn-success dropdown-toggle alert' : 'btn btn-secondary dropdown-toggle'" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{contact_name}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a v-for="(value,index) in contacts" :key="index" class="dropdown-item" @click="selectContact(index, value.name + ' ' + value.surname)" required>{{value.name + ' ' + value.surname}}</a>
                            </div>
                        </div>
                        <label for="name">Name</label>
                        <input id="name" class="form-control mr-sm-2" type="text" v-model="info.name">
                        <label for="surname">Surname</label>
                        <input id="surname" class="form-control mr-sm-2" type="text" v-model="info.surname">
                        <label for="id_number">ID Number</label>
                        <input id="id_number" class="form-control mr-sm-2" type="text" v-model="info.id_number">
                        <button class="btn btn-secondary" :disabled="id === '' ? true : false" @click.prevent="update()">Update</button>
                    </div>
                    <div v-else class="card-header">
                        <form>
                            <div class="row">
                                <div class="dropdown col-6">
                                    <button :class="id === '' ? 'btn btn-success dropdown-toggle alert' : 'btn btn-secondary dropdown-toggle'" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{contact_name}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a v-for="(value,index) in contacts" :key="index" class="dropdown-item" @click="selectContact(index, value.name + ' ' + value.surname)" required>{{value.name + ' ' + value.surname}}</a>
                                    </div>
                                </div>
                                <div class="dropdown col-6">
                                    <button :class="id === '' ? 'btn btn-success dropdown-toggle alert' : 'btn btn-secondary dropdown-toggle'" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{specific_name}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a v-for="(value,index) in calcSpecificContactDetails" :key="index" class="dropdown-item" @click="specificContactSelect(value.id, index)" required>{{index}}</a>
                                    </div>
                                </div>
                            </div>
                            <label for="surname">Contact Number</label>
                            <input id="surname" class="form-control mr-sm-2" type="text" required v-model="contact_info.contact_number">
                            <label for="contact_number">Email Address</label>
                            <input id="contact_number" class="form-control mr-sm-2" type="text" required v-model="contact_info.email">
                            <button class="btn btn-secondary" :disabled="id === '' || specific_id === '' ? true : false" @click.prevent="update()">Update</button>
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
                    email: '',
                    contact_number: ''
                },
                id: '',
                specific_id: '',
                specific_name: 'Select id',
                component_loaded: false,
                contacts: '',
                contact_name: 'Select Contact',
                is_show: true
            }
        },
        methods: {
            update(){
                let envelope = {};
                if (this.is_show === true) {
                    envelope = this.info;
                    envelope['id'] = this.id;
                } else {
                    envelope = this.contact_info,
                    envelope['id'] = this.id;
                    envelope['specific_id'] = this.specific_id;
                }
                axios.post('/contacts/update',{
                    info: envelope,
                    choice: this.is_show
                    })
                .then( response => {
                    this.getContacts();
                    alert(response.data.status);
                })
            },
            selectContact(id,name){
                this.contact_name = name;
                this.id = id;
            },
            specificContactSelect(id,name){
                this.specific_name = name;
                this.specific_id = id;
            },
            getContacts(){
                axios.get('/contacts').then( response => {
                    this.contacts = response.data;
                })
            },
        },
        computed: {
            calcSpecificContactDetails(){
                if (this.id !== ''){
                    return this.contacts[this.id].addresses
                }
            },
        }

    }
</script>
