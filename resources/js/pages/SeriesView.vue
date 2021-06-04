<style scoped lang="scss">
@import "../../sass/_variables.scss";

#series{
    padding: 0 16px;

    .v-divider{
        display: none;
    }
}

.header-content{
    padding: 60px 0 0 0;

    .header-description{
        margin-top: 24px;
        padding: 16px;
        text-align: left;
        background-color: #fafafa;

        span{
            font-size: 10pt;
            font-weight: 700;
        }

        p{
            margin: 0;
        }
    }
}



@media (min-width: 600px) {
    .header-content{
        padding: 65px 0;
    }

    #series{
        padding: 0 30px;

        .v-divider{
            display: block;
        }
    }

}
@media (min-width: 768px) {
    .header-content{
        padding: 70px 0 76px 0;
    }


}
@media (min-width: 960px) {
    .header-content{

        .header-description{
            padding: 24px;

            span{
                font-size: 11pt;
            }

            p{
                font-size: 13pt;
            }
        }
    }

}
@media (min-width: 1200px) {

}


</style>

<template>
    <div>
        {{seriesCompound.isEmpty}}
        <div v-if="seriesLoadStatus===1">
            <div class="content-spacer"></div>
            <div class="d-flex justify-center">
                <v-progress-circular indeterminate></v-progress-circular>
            </div>
        </div>
        <div v-else-if="seriesLoadStatus===2 && !seriesCompound.isEmpty">
            <v-layout
                id="series"
            >
                <v-container class="">

                    <div class="header-content ">
                        <p class="header-caption">{{seriesCompound.series.duration}}</p>
                        <h1 class="header-title">{{seriesCompound.series.title}}</h1>
                        <div class="header-description">
                            <span>DESCRIPTION</span>
                            <div>{{seriesCompound.series.description}}</div>
                        </div>
                    </div>
                    <v-divider></v-divider>
                </v-container>
            </v-layout>
            <v-layout
                class="content"
            >
                <v-container>
                    <p class="content-heading">{{ computeSermonsCount(seriesCompound.series.sermon_count) }}</p>
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            v-for="sermon in seriesCompound.sermons"
                            :key="sermon.id"
                            @click="routeToSermon(sermon.slug)"
                        >
                            <div class="content-card">
                                <v-divider></v-divider>
                                <p class="content-caption">{{computeDate(sermon.published_date)}}</p>
                                <p class="content-title">{{ sermon.title }}</p>
                                <!--                            <p class="content-subtitle" v-if="sermon.series != null">{{ sermon.series.title }}</p>-->
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
                </v-container>
            </v-layout>
        </div>
        <div v-else-if="seriesLoadStatus===3">
            <p>An error occurred</p>
        </div>
        <div class="message" v-else>
            <p>Series not found</p>
        </div>

    </div>
</template>

<script>
import {API} from "../config";

export default {
    props:['slug'],
    data: () => ({

    }),
    components:{

    },
    created(){
        window.scrollTo(0,0)
        this.$store.dispatch('SeriesShow',{
            slug:this.slug
        })
    },
    mounted(){

    },
    computed: {
        seriesCompound(){
            return this.$store.getters.getSingleSeries
        },
        seriesLoadStatus(){
            return this.$store.getters.getSingleSeriesLoadStatus
        }
    },
    watch: {
        slug:function () {
            this.$store.dispatch('SermonShow',{
                slug:this.slug
            })
        }


    },
    methods:{
        computeImageUrl(url){
            return API.URL+url
        },
        routeToSermon(slug){
            this.$router.push({name:"sermon", params:{slug:slug}})
        },
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
    }

}
</script>
