<style scoped lang="scss">
@import "../../sass/_variables.scss";

</style>

<template>
    <div>
        <v-layout
            id="series"
            class="header"
            justify-center
            align-center
            :style="{
                    backgroundImage:`url(${computeImageUrl('images/series.jpg')})`
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
                <h1 class="header-title">Series</h1>
                <div  v-if="seriesLoadStatus===1">
                    <div class="content-spacer"></div>
                    <div class="d-flex justify-center">
                        <v-progress-circular indeterminate></v-progress-circular>
                    </div>
                </div>
                <div
                    v-else-if="seriesLoadStatus===2"
                    class="compound-view-container"
                    v-for="(seriesCompound,index) in series"
                    :index="index"
                >
                    <p class="content-heading">{{ seriesCompound.year + " Series" }}</p>
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            v-for="singleSeries in seriesCompound.series"
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
                </div>


                <div v-if="seriesAppendStatus!==1" v-show="moreSeries" class="content-button">
                    <button :disabled="seriesAppendStatus===1" @click="loadMore">Load More</button>
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
        series:function(){
            let unfiltered=this.$store.getters.getSeries
            let filtered=[]

            if(unfiltered){
                for (let item in unfiltered){
                    if (unfiltered[item].sermon_count!==0){
                        filtered.push(unfiltered[item])
                    }
                }

                //sorting series
                let sorted=[]
                let index=0

                if (filtered.length!==0){
                    let currentYear=filtered[0].duration_year

                    for (let item in filtered){
                        if (item==='0'){
                            sorted.push({
                                year: currentYear,
                                series:[filtered[item]]
                            })
                        }else{
                            if (currentYear===filtered[item].duration_year){
                                sorted[index].series.push(filtered[item])
                            }else{
                                index++
                                currentYear=filtered[item].duration_year

                                sorted.push({
                                    year: currentYear,
                                    series:[filtered[item]]
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
        seriesLoadStatus(){
            return this.$store.getters.getSeriesLoadStatus
        },
        seriesAppendStatus(){
            return this.$store.getters.getSeriesAppendStatus
        },
        moreSeries(){
            return this.$store.getters.getMoreSeries
        }
    },
    watch: {


    },
    methods:{
        loadMore(){
            this.$store.dispatch('AppendSeries')
        },
        computeSermonsCount(count){
            switch (count){
                case 1:
                    return count + " Sermon"
                default:
                    return count + " Sermons"
            }
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
