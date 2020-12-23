<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="nowrap" @click="sortBy('age')">age<i v-if="sortName=='age'" :class="sort == 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'"></i></th>
                <th scope="col" class="nowrap" @click="sortBy('eyeColor')">eyeColor<i v-if="sortName=='eyeColor'" :class="sort == 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'"></i></th>
                <th scope="col" class="nowrap" @click="sortBy('name')">name<i v-if="sortName=='name'" :class="sort == 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'"></i></th>
                <th scope="col" class="nowrap" @click="sortBy('gender')">gender<i v-if="sortName=='gender'" :class="sort == 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'"></i></th>
                <th scope="col" class="nowrap" @click="sortBy('company')">company<i v-if="sortName=='company'" :class="sort == 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'"></i></th>
                <th scope="col" class="nowrap" @click="sortBy('email')">email<i v-if="sortName=='email'" :class="sort == 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'"></i></th>
                <th scope="col" class="nowrap" @click="sortBy('phone')">phone<i v-if="sortName=='phone'" :class="sort == 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'"></i></th>
                <th scope="col" class="nowrap" @click="sortBy('address')">address<i v-if="sortName=='address'" :class="sort == 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'"></i></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in contacts">
                <td>{{ item.age }}</td>
                <td>{{ item.eyeColor }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.gender }}</td>
                <td>{{ item.company }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.phone }}</td>
                <td>{{ item.address }}</td>
            </tr>
            </tbody>
        </table>
        <button @click="getContacsMore" v-if="total > contacts.length">Read More</button>
    </div>
</template>

<script>
    export default {
        props:['data','total'],
        data(){
            return {
                contacts:[],
                slice:0,
                sort:null,
                sortName:null
            }
        },
        mounted() {
            this.contacts = this.data;
        },
        methods:{
            getContacsMore(){
                this.slice += 2;
                axios.get('/', {params: {slice:this.slice,sort:this.sort,sortName:this.sortName,perPage:this.contacts.length}}).then( response => {
                   this.contacts = this.contacts.concat(Object.values(response.data));
                });
            },
            sortBy(name){
                this.sortName = name;
                if(this.sort == 'asc'){
                    this.sort = 'desc';
                }else if(this.sort == 'desc'){
                    this.sort = null;
                    this.sortName = null;
                }else{
                    this.sort = 'asc';
                }
                axios.get('/', {params: {sort:this.sort,sortName:this.sortName,perPage:this.contacts.length}}).then( response => {
                    this.contacts = Object.values(response.data);
                });
            }
        }
    }
</script>
<style>
    .nowrap {
        white-space:nowrap;
    }
</style>
