<style scoped lang="scss">
@import "../../sass/_variables.scss";

</style>

<template>
    <div>
        <v-layout
            id="sermons"
            class="header"
            justify-center
            align-center
            :style="{
                    backgroundImage:`url(${computeImageUrl('images/sermons-2.jpg')})`
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
                <h1 class="header-title">Sermons</h1>
                <div  v-if="sermonsLoadStatus===1">
                    <div class="content-spacer"></div>
                    <div class="d-flex justify-center">
                        <v-progress-circular indeterminate></v-progress-circular>
                    </div>
                </div>
                <div
                    v-else-if="sermonsLoadStatus===2"
                    class="compound-view-container"
                    v-for="(sermonCompound,index) in sermons"
                    :index="index"
                >
                    <p class="content-heading">{{ sermonCompound.month + " " + sermonCompound.year }}</p>
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            v-for="sermon in sermonCompound.sermons"
                            :key="sermon.id"
                            @click="routeToSermon(sermon.slug)"
                        >
                            <div class="content-card">
                                <v-divider></v-divider>
                                <p class="content-caption">{{computeDate(sermon.published_date)}}</p>
                                <p class="content-title">{{ sermon.title }}</p>
                                <p class="content-subtitle" v-if="sermon.series != null">{{ sermon.series.title }}</p>
                                <div class="d-flex align-center content-avatar">
                                    <div class="content-avatar-img"
                                         :style="{
                                        backgroundImage:`url(${computeImageUrl(sermon.author.avatar)})`
                                     }"
                                    ></div>
                                    <div class="content-avatar-name"><span>{{ sermon.author.name }}</span></div>
                                </div>
                            </div>
                        </v-col>
                    </v-row>
                </div>
                <div class="message"    v-if="sermons.length===0 && sermonsLoadStatus===2">
                    <p>Sermons not found</p>
                </div>


                <div v-if="sermonsAppendStatus!==1" v-show="morePages && sermonsLoadStatus!==1" class="content-button">
                    <button :disabled="sermonsAppendStatus===1" @click="loadMore">Load More</button>
                </div>
                <div v-else>
                    <div class="content-spacer"></div>
                    <div class="d-flex justify-center">
                        <v-progress-circular indeterminate></v-progress-circular>
                    </div>
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
        sermons:function(){
            let unsorted=this.$store.getters.getSermons
            let sorted=[]
            let index=0

            if(unsorted){
                if (unsorted.length!==0){
                    let currentMonth=unsorted[0].published_date.month
                    let currentYear=unsorted[0].published_date.year

                    for (let item in unsorted){
                        if (item==='0'){
                            sorted.push({
                                month: currentMonth,
                                year: currentYear,
                                sermons:[unsorted[item]]
                            })
                        }else{
                            if (currentMonth===unsorted[item].published_date.month && currentYear===unsorted[item].published_date.year){
                                sorted[index].sermons.push(unsorted[item])
                            }else{
                                index++
                                currentMonth=unsorted[item].published_date.month
                                currentYear=unsorted[item].published_date.year

                                sorted.push({
                                    month: currentMonth,
                                    year: currentYear,
                                    sermons:[unsorted[item]]
                                })
                            }
                        }
                    }
                    return sorted
                }else
                    return []
            }else
                return []

        },
        sermonsLoadStatus(){
            return this.$store.getters.getSermonsLoadStatus
        },
        sermonsAppendStatus(){
            return this.$store.getters.getSermonsAppendStatus
        },
        morePages(){
            return this.$store.getters.getMoreSermons
        }
    },
    watch: {


    },
    methods:{
        loadMore(){
            this.$store.dispatch('AppendSermons')
        },
        computeDate:function (date) {
            return date.month + " " + date.day + ", " + date.year
        },
        routeToSermon(slug){
            this.$router.push({name:"sermon", params:{slug:slug}})
        },
        computeImageUrl(url){
            return API.URL+url
        },

    }

}
</script>
