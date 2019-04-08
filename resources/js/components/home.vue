<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div v-for="(value,index) in searchResults" :key="index" class="card-header">
                        <p>Name: {{value.name}} </p>
                        <p>Surname: {{value.surname}} </p>
                        <p>id_number: {{value.id_number}} </p>
                        <p>Addresses: 
                            <div v-for="(value,index) in value.addresses" :key="index">
                                <ul>
                                    <li>{{value.email}}</li>
                                    <li>{{value.contact_number}}</li>
                                </ul>
                            </div>
                        </p>
                        <a class="btn btn-secondary" @click.prevent="deleteEntry(index)">Delete</a>
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
            this.component_loaded = true;
        },  
        data(){
            return {
                contacts: '',
                component_loaded: false,
            }
        },
        computed: {
            ...mapState('search',{search: state => state.searchData}),
            searchResults() {
                if (this.component_loaded === true) {
                    if (Object.keys(this.search).length === 0) {
                        return this.contacts;
                    }
                    let result = {};
                    for (let i in this.contacts) {
                        for (let j in this.contacts[i]) {
                            if (this.contacts[i][j].length > 0) {
                                for (let k in this.contacts[i][j]) {
                                    for (let s in this.contacts[i][j][k])
                                    {
                                        if (this.contacts[i][j][k][s] !== null && this.contacts[i][j][k][s].toString().toLowerCase().includes(this.search)) {
                                            if (s === 'email' || s === 'contact_number') {
                                                result[i] = this.contacts[i];
                                            }

                                        }
                                    }
                                }
                            }
                            if (this.contacts[i][j].toString().toLowerCase().includes(this.search.toLowerCase())) {
                                result[i] = this.contacts[i]
                            }
                        }
                    }
                    return result;    
                }

            }

        },
        methods: {
            deleteEntry(id){
                axios.post('/contacts/delete',{id}).then( response => {
                    this.component_loaded = false
                    delete this.contacts[id];
                    this.component_loaded = true;
                    alert(response.data.status);
                })
            },
            getContacts(){
                axios.get('/contacts').then( response => {
                    this.contacts = response.data;
                })
            }
        }

    }
</script>
