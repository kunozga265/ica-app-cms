<style scoped lang="scss">
@import "../../sass/_variables.scss";

.pastor-card{
    position: relative;
    padding: 0 0 16px 0;

    .pastor-card-content{
      padding-right: 90px;
    }

    .content-image{
        position: absolute;
        right: 0;
        border-radius: 5px;
        width: 85px;
        height: 85px;
        background-color: #fafafa;
        background-position:center;
        background-repeat:none;
        background-size: cover;
    }

    .v-divider{
        margin-bottom: 16px;
    }

    .sermon-count{
        //position: relative;
    }
}

@media (min-width: 600px) {
    .pastor-card{
        position: relative;
        padding: 0 0 60px 0 ;
        border: thin solid rgba(0,0,0,.12);
        border-radius: 5px;
        height: 100%;

        .content-image{
            position: relative;
            width: 100%;
            height: 200px;
            border-radius: 5px 5px 0 0;
        }

        .pastor-card-content{
            padding: 16px 16px 0 16px;
        }

        //.sermon-count{
        //     padding: 0;
        //     margin: 12px 0 0 0;
        //}
    }
}

@media (min-width: 768px) {
    .pastor-card {
        .content-image {
            height: 250px;
        }
    }
}

@media (min-width: 960px) {
    .pastor-card {
        .pastor-card-content{
            padding: 24px 24px 0 24px;
        }
    }
}


@media (min-width: 1265px) {
    .pastor-card {
        .content-image {
            height: 350px;
        }
    }
}



</style>

<template>
    <div>
        <v-layout
            id="pastors"
            class="header"
            justify-center
            align-center
            :style="{
                    backgroundImage:`url(${computeImageUrl('images/pastors.jpg')})`
                 }"
        >
            <v-container class="d-flex">
                <div class="header-content ">
<!--                    <p class="header-caption">May 28, 2021</p>-->
<!--                    <h1 class="header-title">Sermons</h1>-->
<!--                    <p class="header-subtitle">This is a short headline</p>-->
                </div>
            </v-container>
        </v-layout>
        <v-layout
            class="content"
        >
            <v-container>
                <h1 class="header-title">Pastors</h1>
                <div  v-if="pastorsLoadStatus===1">
                    <div class="content-spacer"></div>
                    <div class="d-flex justify-center">
                        <v-progress-circular indeterminate></v-progress-circular>
                    </div>
                </div>
                <div v-if="(pastors.ica).length>=1 && pastorsLoadStatus===2">
                    <p class="content-heading" >ICA Pastors</p>
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            v-for="pastor in pastors.ica"
                            :key="pastor.id"
                            @click="routeToPastor(pastor.slug)"
                        >
                            <div class="pastor-card">
                                <v-divider></v-divider>
                                <div class="content-image"
                                     :style="{
                                        backgroundImage:`url(${computeImageUrl(pastor.avatar)})`
                                     }"
                                ></div>
                                <div class="pastor-card-content">
                                    <p class="content-title">{{pastor.name}}</p>
                                    <p class="content-description">{{ pastor.title }}</p>
                                    <p class="sermon-count">{{ computeSermonsCount(pastor.sermon_count)}}</p>
                                </div>
                            </div>
                        </v-col>
                    </v-row>
                </div>
                <div v-if="(pastors.other).length>=1 && pastorsLoadStatus===2">
                    <div class="content-spacer"></div>
                    <p class="content-heading">Other Ministers</p>
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            v-for="pastor in pastors.other"
                            :key="pastor.id"
                            @click="routeToPastor(pastor.slug)"
                        >
                            <div class="pastor-card">
                                <v-divider></v-divider>
                                <div class="content-image"
                                     :style="{
                                        backgroundImage:`url(${computeImageUrl(pastor.avatar)})`
                                     }"
                                ></div>
                                <div class="pastor-card-content">
                                    <p class="content-title">{{pastor.name}}</p>
                                    <p class="content-description">{{ pastor.title }}</p>
                                    <p class="sermon-count">{{ computeSermonsCount(pastor.sermon_count)}}</p>
                                </div>
                            </div>
                        </v-col>
                    </v-row>
                </div>
                <div class="message" v-if="(pastors.ica).length===0 && (pastors.other).length===0 && pastorsLoadStatus===2">
                    <p>No pastors found</p>
                </div>
            </v-container>
        </v-layout>
    </div>
</template>

<script>
import {API} from "../config";

export default {
    data: () => ({

    }),
    components:{

    },
    created(){
        window.scrollTo(0,0)

    },
    mounted(){

    },
    computed: {
        pastors(){
            let unfiltered=this.$store.getters.getAuthors
            let filtered={
                ica:[],
                other:[]
            }

            if (unfiltered){
                for (let item in unfiltered){
                    if (unfiltered[item].ica_pastor==1)
                        filtered.ica.push(unfiltered[item])
                    else
                        filtered.other.push(unfiltered[item])
                }
                return filtered
            }else
                return filtered
        },
        pastorsLoadStatus(){
            return this.$store.getters.getAuthorsLoadStatus
        }

    },
    watch: {


    },
    methods:{
        computeSermonsCount(count){
            switch (count){
                case 1:
                    return count + " Sermon"
                default:
                    return count + " Sermons"
            }
        },
        routeToPastor(slug){
            this.$router.push({name:"pastor", params:{slug:slug}})
        },
        computeImageUrl(url){
            return API.URL+url
        },
    }
}
</script>
