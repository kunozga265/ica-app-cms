<template>
    <v-app-bar app color="white" absolute flat>
        <v-toolbar-title>
            <router-link  :to="{ name: 'home' }">
                <img id="logo" :src="computeImageUrl('images/logo-main.png')" alt="ICA Logo"/>
            </router-link>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon :to="{ name: 'search' }">
            <v-icon color="">mdi-magnify</v-icon>
        </v-btn>
        <v-app-bar-nav-icon @click.stop="$emit('toggle-drawer')"></v-app-bar-nav-icon>
    </v-app-bar>
</template>

<script>
import {API} from "../../config";
export default {
    name: "AppHeader",

    methods:{
        computeImageUrl(url){
            return API.URL+url
        }
    }
}
</script>

<style scoped>
#logo{
    margin-top: 3px;
    height: 50px;
    width: 50px;
}
</style>
