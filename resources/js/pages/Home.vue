<style scoped lang="scss">
@import "../../sass/_variables.scss";

p.latest-sermon {
    //color: rgba(265,265,265,.8);
    font-size: 9pt;
    font-weight: 500;
    margin-bottom: 16px;
    position: absolute;
    left: 0;
    top: 0;
    background-color: rgba(0,0,0,0.3);
    padding: 10px 15px;
}

@media (min-width: 600px) {
    p.latest-sermon {
        //left: 12px;
        //top: 12px;
        font-size: 10pt;
        padding: 12px 17px;
    }

}
@media (min-width: 768px) {
    p.latest-sermon {
        //left: 0;
        //top: 0;
        font-size: 11pt;
        padding: 14px 19px;

    }
}
@media (min-width: 960px) {
    p.latest-sermon {
        font-size: 12pt;
        padding: 16px 21px;
    }
}
@media (min-width: 1200px) {
    p.latest-sermon {
        font-size: 13pt;
        padding: 18px 23px;
    }
}


</style>

<template>
    <div>
        <div  v-if="sermonsLoadStatus===1 && seriesLoadStatus===1">-->
            <div class="content-spacer"></div>
            <div class="d-flex justify-center">
                <v-progress-circular indeterminate></v-progress-circular>
            </div>
        </div>
        <div v-else-if="sermonsLoadStatus===2 && seriesLoadStatus===2">
            <v-layout
                id="latest-sermon"
                class="header"
                justify-center
                align-center
                :style="{
                    backgroundImage:`url(${computeImageUrl('images/hero-background.jpg')})`
                 }"
            >
                <v-container class="d-flex">
                    <div class="header-content ">
                        <div v-if="sermons.length>=1">
                            <p class="latest-sermon">LATEST SERMON</p>
                            <!--                    <p class="header-caption">May 28, 2021</p>-->
                            <h1 class="header-title">{{sermons[0].title}}</h1>
                            <p class="header-subtitle" v-if="sermons[0].series != null">{{ sermons[0].series.title }}</p>
                            <div class="d-flex align-center justify-center header-avatar">
                                <div class="header-avatar-img"
                                     :style="{
                                        backgroundImage:`url(${computeImageUrl(sermons[0].author.avatar)})`
                                     }"
                                ></div>
                                <div class="header-avatar-name"><span>{{sermons[0].author.name}}</span></div>
                            </div>
                        </div>
                        <!--                    <div v-else>-->
                        <!--                        <h1>No sermons Available</h1>-->
                        <!--                    </div>-->
                    </div>
                </v-container>
            </v-layout>
            <v-layout
                class="content"
            >
                <v-container>
                    <p class="content-heading">Recent Sermons</p>
                    <div v-if="sermons.length>=1">
                        <v-row>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                                v-for="sermon in sermons"
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
                        <div v-if="sermons.length!==0" class="content-button">
                            <button @click="routeToSermons">View All</button>
                        </div>
                        <div class="message" v-else>
                            <p>No sermons found</p>
                        </div>
                    </div>
                    <div v-else>
                        <div class="content-spacer"></div>
                        <div class="d-flex justify-center">
                            <v-progress-circular indeterminate></v-progress-circular>
                        </div>
                    </div>
                </v-container>
            </v-layout>
            <v-layout
                class="content"
                style="background-color: #fafafa"
            >
                <v-container>
                    <p class="content-heading">Recent Series</p>
                    <div v-if="series.length>=1">
                        <v-row>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                                v-if="seriesLoadStatus===2"
                                v-for="singleSeries in series"
                                :key="singleSeries.id"
                                @click="routeToSeriesView(singleSeries.slug)"
                            >
                                <div class="content-card">
                                    <v-divider></v-divider>
                                    <p class="content-caption">{{singleSeries.duration}}</p>
                                    <p class="content-title">{{ singleSeries.title }}</p>
                                    <p class="content-description">{{ singleSeries.description}}</p>
                                    <p class="sermon-count">{{ computeSermonsCount(singleSeries.sermon_count) }}</p>
                                </div>
                            </v-col>
                        </v-row>
                        <div v-if="series.length!==0" class="content-button">
                            <button @click="routeToSeries">View All</button>
                        </div>
                        <div class="message" v-else>
                            <p>No series found</p>
                        </div>
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
            let sermons=this.$store.getters.getSermons
            let limit=6

            if (sermons){
                if(sermons.length>=1)
                    return sermons.slice(0,limit)
                else
                    return []
            }else
                return []
        },
        sermonsLoadStatus(){
            return this.$store.getters.getSermonsLoadStatus
        },
        series:function(){
            let unfiltered=this.$store.getters.getSeries
            let filtered=[]
            let index=0;
            let limit=3

            for (let item in unfiltered){
                if (unfiltered[item].sermon_count!==0 && index!==limit){
                    filtered.push(unfiltered[item])
                    index++
                }
            }

            return filtered

        },
        seriesLoadStatus(){
            return this.$store.getters.getSeriesLoadStatus
        },
    },
    watch: {


    },
    methods:{
        computeDate:function (date) {
            return date.month + " " + date.day + ", " + date.year
        },
        computeSermonsCount(count){
            switch (count){
                case 1:
                    return count + " Sermon"
                default:
                    return count + " Sermons"
            }
        },
        routeToSermons(){
            this.$router.push({name:"sermons"})
        },
        routeToSermon(slug){
            this.$router.push({name:"sermon", params:{slug:slug}})
        },
        routeToSeries(){
            this.$router.push({name:"series"})
        },
        routeToSeriesView(slug){
            this.$router.push({name:"series-view", params:{slug:slug}})
        },
        computeImageUrl(url){
            return API.URL+url
        },
    }
}

</script>
