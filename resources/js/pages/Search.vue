<style scoped lang="scss">
@import "../../sass/_variables.scss";

.header-content{
    padding: 60px 16px 24px 16px;
}

.searchbar{
    position: relative;
    max-width: 1161px;
    margin: 24px auto 0 auto;

    input{
        width: 100%;
        position: relative;
        padding: 12px 62px 12px 12px;
        border: thin solid rgba(0,0,0,0.2);

        &:focus{
            border: thin solid rgba(0,0,0,0.2);
            outline: none;
        }
    }

    .icon{
        position: absolute;
        height: 100%;
        width: 50px;
        background-color: #ececec;
        border: thin solid rgba(0,0,0,0.2);
        border-left: none;
        //left: 0;
        right: 0;
        z-index: 1;

        &:hover{
            cursor:pointer
        }
    }
}

.search-results{
    padding: 16px 0 0 0;

    .row .col-sm-6:first-child{
        .v-divider{
            display: none;
        }
        .content-caption{
            margin-top: 0;
        }
    }
}

#search{
    padding-top: 12px;
    padding-bottom: 12px;
}

.v-tabs-slider{
    background-color: rgba(0,0,0,0.12);
}


@media (min-width: 600px) {
    .header-content{
        padding: 65px 24px 24px 24px;
    }

    .searchbar {
        input {
            padding: 12px 62px 12px 24px;
        }
    }

}
@media (min-width: 768px) {
    .header-content{
        padding: 70px 30px 24px 30px;
    }
}
@media (min-width: 960px) {
    .header-content{
        padding: 70px 0 24px 0;
    }
}
@media (min-width: 1200px) {

}


</style>

<template>
    <div>
        <v-layout

        >
            <v-container class="">
                <div class="header-content ">
                    <h1 class="header-title">Search</h1>
<!--                    <p class="header-caption">Find sermons and series</p>-->
<!--                    <p class="header-subtitle">A life sought after by many</p>-->
                    <div class="searchbar">
                        <div class="icon  d-flex justify-center align-center" @click="search">
                            <v-icon>mdi-magnify</v-icon>
                        </div>
                        <input  v-on:keyup.enter="search" v-model="query"  type="text" placeholder="Find sermons and series">
                    </div>
                </div>
            </v-container>
        </v-layout>
        <div  v-if="searchResultsStatus===1">
            <div class="content-spacer"></div>
            <div class="d-flex justify-center">
                <v-progress-circular indeterminate></v-progress-circular>
            </div>
        </div>
        <div v-else-if="searchResultsStatus===2">
            <v-tabs
                v-model="tab"
                centered
                grow
                class="custom-font"
            >
                <v-tabs-slider></v-tabs-slider>

                <v-tab href="#sermons"><span class="">Sermons {{computeLength((searchResults.sermons))}}</span></v-tab>
                <v-tab href="#series"><span class="">Series {{computeLength((searchResults.series))}}</span></v-tab>
            </v-tabs>
            <v-layout
                id="search"
                class="content"
            >
                <v-container>


                    <v-tabs-items v-model="tab" class="search-results" >
                        <v-tab-item
                            key="1"
                            value="sermons"
                        >
                            <v-row   v-if="searchResultsStatus===2 && !(searchResults.sermons).isEmpty">
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                    v-for="sermon in searchResults.sermons"
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

                            <div class="message" v-if="searchResultsStatus===2 && (searchResults.sermons).length===0">
                                <p>Sermons not found</p>
                            </div>
                        </v-tab-item>
                        <v-tab-item
                            key="2"
                            value="series"
                        >
                            <v-row   v-if="searchResultsStatus===2 && !(searchResults.series).isEmpty">
                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                    v-for="singleSeries in searchResults.series"
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
                            <div class="message" v-if="searchResultsStatus===2 && (searchResults.series).length===0">
                                <p>Series not found</p>
                            </div>
                        </v-tab-item>
                    </v-tabs-items>
                </v-container>
            </v-layout>
        </div>
    </div>
</template>

<script>
import {API} from "../config";

export default {
    data() {
        return {
            tab: "sermons",
            query: ""
        }
    },
    created() {
        window.scrollTo(0,0)
    },
    computed:{
        searchResults(){
            let results= this.$store.getters.getSearchResults
            if (results)
                return results
            else
                return {sermons:[],series:[]}
        },
        searchResultsStatus(){
             return this.$store.getters.getSearchResultsStatus
        },
    },
    methods:{
        search(){
            if (this.query.length>0){
                this.$store.dispatch('SermonsSearch',{
                    query:this.query
                })}
        },
        computeDate:function (date) {
            return date.month + " " + date.day + ", " + date.year
        },
        routeToSermon(slug){
            this.$router.push({name:"sermon", params:{slug:slug}})
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
        computeLength(object){
            if (object) {
                if(object.length>0)
                    return "(" + object.length + ")"
                else
                    return ""
            }
            else
                return ""
        },
        computeImageUrl(url){
            return API.URL+url
        },
    },
    beforeDestroy() {
        this.$store.dispatch('SermonsClearSearch')
    }
}
</script>
