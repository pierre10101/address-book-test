<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Address Book</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <router-link class="nav-link" to="/">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/create">Create</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/update">Update</router-link>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="" @keyup="searchField()" v-model="search" @click="change()">
            </form>
        </div>
    </nav>
</template>

<script>
    import {mapState} from 'vuex';
    export default {
        mounted() {
            
        },
        data(){
            return {
                search: '',
            }
        },
        methods: {
            searchField(){
                this.$store.commit('search/updateSearch', this.search);
            },
            change(){
                if(this.$route.path === '/create' || this.$route.path === '/update') {
                    this.$router.push('/')
                }
            }
        },
    }
</script>
