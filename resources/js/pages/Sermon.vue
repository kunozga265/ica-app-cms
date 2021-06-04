<style scoped lang="scss">
@import "../../sass/_variables.scss";

#sermon{
    font-family: 'Raleway', sans-serif;
    color:$app-color;
    padding: 0 16px;
}

.header-content{
    padding: 60px 0;
}

.sermon-avatar {
    margin-top: 24px;
    text-align: left;

    .sermon-avatar-img {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        background-color: white;
        background-position: center;
        background-repeat: none;
        background-size: cover;

        &:hover{
            cursor: pointer;
        }
    }

    .sermon-avatar-name {
        margin-left: 10px;

        h4 {
            margin: 0;
            font-weight: 600;
            font-size: 12pt;
        }

        p {
            margin: 0;
            font-size: 10pt;
        }

        &:hover{
            cursor: pointer;
        }
    }
}


@media (min-width: 600px) {
    .header-content{
        padding: 65px 0;
    }

    #sermon{
        padding: 0 30px;
    }

    .sermon-avatar {
        margin-top: 24px;

        .sermon-avatar-img {
            height: 60px;
            width: 60px;
        }

        .sermon-avatar-name {
            margin-left: 12px;

            h4 {
                margin: 0;
                font-size: 13pt;
            }

            p {
                margin: 0;
                font-size: 11pt;
            }

        }
    }

}
@media (min-width: 768px) {
    .header-content{
        padding: 70px 0;
    }

    .sermon-avatar {

        .sermon-avatar-img {
            height: 70px;
            width: 70px;
        }

        .sermon-avatar-name {
            margin-left: 16px;

            h4 {
                margin: 0;
                font-size: 14pt;
            }

            p {
                margin: 0;
                font-size: 12pt;
            }

        }
    }

}
@media (min-width: 960px) {

}
@media (min-width: 1200px) {

}


</style>

<template>
    <div>
        <div v-if="sermonLoadStatus===1">
            <div class="content-spacer"></div>
            <div class="d-flex justify-center">
                <v-progress-circular indeterminate></v-progress-circular>
            </div>
        </div>
        <div v-else-if="sermonLoadStatus===2 && !sermonCompound.isEmpty">
            <v-layout
                id="sermon"
            >
                <v-container class="">
                    <div class="header-content ">
                        <p class="header-caption">{{computeDate(sermonCompound.sermon.published_date)}}</p>
                        <h1 class="header-title" >{{sermonCompound.sermon.title}}</h1>
                        <p class="header-subtitle" v-if="sermonCompound.sermon.series">{{sermonCompound.sermon.series.title}}</p>
                    </div>
                    <v-divider></v-divider>
                    <div class="d-flex align-center sermon-avatar">
                        <div class="sermon-avatar-img"
                             :style="{
                                        backgroundImage:`url(${computeImageUrl(sermonCompound.sermon.author.avatar)})`
                                     }"
                             @click="routeToPastor(sermonCompound.sermon.author.slug)"
                        ></div>
                        <div class="sermon-avatar-name" @click="routeToPastor(sermonCompound.sermon.author.slug)">
                            <h4>{{sermonCompound.sermon.author.name}}</h4>
                            <p>{{sermonCompound.sermon.author.title}}</p>
                        </div>
                    </div>
                </v-container>
            </v-layout>
            <v-layout
                class="content"
            >
                <v-container>
                    <div v-html="sermonCompound.sermon.body"></div>
                </v-container>
            </v-layout>
            <v-layout
                class="content"
                style="background-color: #fafafa"
                v-if="(sermonCompound.sermonSeries).length!==0"
            >
                <v-container>
                    <p class="content-heading">Sermons in this series</p>
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            v-for="sermon in sermonCompound.sermonSeries"
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
                    <div class="content-button">
                        <button   @click="routeToSeriesView(sermonCompound.sermon.series.slug)">View series</button>
                    </div>
                </v-container>
            </v-layout>
        </div>
        <div v-else-if="sermonLoadStatus===3">
            <p>An error occurred</p>
        </div>
        <div class="message" v-else>
            <p>Sermons not found</p>
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
        this.$store.dispatch('SermonShow',{
            slug:this.slug
        })
    },
    mounted(){

    },
    computed: {
        sermonCompound(){
            return this.$store.getters.getSermon
        },
        sermonLoadStatus(){
            return this.$store.getters.getSermonLoadStatus
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
        computeDate:function (date) {
            return date.month + " " + date.day + ", " + date.year
        },
        computeImageUrl(url){
            return API.URL+url
        },
        routeToSermon(slug){
            this.$router.push({name:"sermon", params:{slug:slug}})
            window.scrollTo(0,0)
        },
        routeToSeriesView(slug){
            this.$router.push({name:"series-view", params:{slug:slug}})
        },
        routeToPastor(slug){
            this.$router.push({name:"pastor", params:{slug:slug}})
        },
    }


}
</script>
