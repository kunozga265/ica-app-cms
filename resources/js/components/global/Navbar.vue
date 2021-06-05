<template>
    <v-navigation-drawer v-model="drawer" app right color="app_color" dark>

        <span class="nav-close">
            <v-btn icon @click="drawer=false">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </span>
        <v-list dense class="mt-8">
            <v-list-item link exact :to="{ name: 'dashboard' }" @click="drawer=false">
                <v-list-item-content>
                    <v-list-item-title ><span class="custom-font bold">DASHBOARD</span></v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item link exact :to="{ name: 'sermons' }" @click="drawer=false">
                <v-list-item-content>
                    <v-list-item-title ><span class="custom-font bold">SERMONS</span></v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item link exact :to="{ name: 'series' }" @click="drawer=false">
                <v-list-item-content>
                    <v-list-item-title ><span class="custom-font bold">SERIES</span></v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item link exact :to="{ name: 'pastors' }" @click="drawer=false">
                <v-list-item-content>
                    <v-list-item-title ><span class="custom-font bold">PASTORS</span></v-list-item-title>
                </v-list-item-content>
            </v-list-item>
<!--            <v-list-item link exact :to="{ name: 'sermon' }" @click="drawer=false">-->
<!--                <v-list-item-content>-->
<!--                    <v-list-item-title ><span class="custom-font bold">SERMON</span></v-list-item-title>-->
<!--                </v-list-item-content>-->
<!--            </v-list-item>-->
<!--            <v-list-item link exact :to="{ name: 'series-view' }" @click="drawer=false">-->
<!--                <v-list-item-content>-->
<!--                    <v-list-item-title ><span class="custom-font bold">SERIES-VIEW</span></v-list-item-title>-->
<!--                </v-list-item-content>-->
<!--            </v-list-item>-->
<!--            <v-list-item link exact :to="{ name: 'pastor' }" @click="drawer=false">-->
<!--                <v-list-item-content>-->
<!--                    <v-list-item-title ><span class="custom-font bold">PASTOR</span></v-list-item-title>-->
<!--                </v-list-item-content>-->
<!--            </v-list-item>-->
        </v-list>
    </v-navigation-drawer>

</template>

<script>
export default {
    name: "Navbar",
    data() {
        return {
            drawer: false
        }
    },
}
</script>

<style scoped>
.v-list-item--active{
    background-color: rgba(0,0,0,0.8);
}

.nav-close{
    position: absolute;
    right: 5px;
    top:5px;
}

</style>
