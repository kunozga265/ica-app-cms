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

</style>

<template>
  <v-col cols="12">
    <div class="content-card">
      <v-divider></v-divider>
      <div class="more-details">
        <v-menu>
          <template v-slot:activator="{on,attrs}">
            <v-btn
                icon
                v-bind="attrs"
                v-on="on"
            >
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </template>
          <v-list>
            <ul class="more-details-dropdown">
              <li>
                <v-btn icon color="info" @click="viewDialog=true"><v-icon>mdi-eye</v-icon></v-btn>
              </li>
              <li v-if="!sermon.trashed">
                <v-btn icon color="success" @click="routeToEditSermon(sermon.slug)"><v-icon>mdi-pencil</v-icon></v-btn>
              </li>
              <li>
                <v-btn icon color="error" @click="deleteDialog=true" :disabled="deleteStatus===1"><v-icon>mdi-delete</v-icon></v-btn>
              </li>
              <li v-if="sermon.trashed">
                <v-btn icon color="success" @click="restoreDialog=true" :disabled="restoreStatus===1"><v-icon>mdi-backup-restore</v-icon></v-btn>
              </li>
            </ul>
          </v-list>
        </v-menu>
      </div>
      <div class="content-wrapper">
        <p class="content-title">{{ sermon.title }}</p>
        <p class="content-subtitle" v-if="sermon.series != null">{{ sermon.series.title }}</p>
        <p class="content-caption">{{computeDate(sermon.published_date)+ " | " + sermon.author.name}}</p>
      </div>
      <v-dialog v-model="deleteDialog" max-width="400">
        <v-card>
          <v-card-title>Are you sure?</v-card-title>
          <v-card-text v-if="sermon.trashed">You are about to permanently delete this sermon. This sermon will not be recoverable.</v-card-text>
          <v-card-text v-else>You are about to delete this sermon. This sermon will be trashed and can later be restored.</v-card-text>
          <v-card-actions>
            <v-btn :disabled="deleteStatus===1" v-if="sermon.trashed" color="error" @click="destroySermon(sermon.slug)">Delete</v-btn>
            <v-btn :disabled="deleteStatus===1" v-else color="error" @click="trashSermon(sermon.slug)">Delete</v-btn>
            <v-btn color="error"  @click="deleteDialog=false" text>Cancel</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-dialog v-if="sermon.trashed" v-model="restoreDialog" max-width="400">
        <v-card>
          <v-card-title>Are you sure?</v-card-title>
          <v-card-text>You are about to restore this sermon.</v-card-text>
          <v-card-actions>
            <v-btn :disabled="restoreStatus===1" color="success" @click="restoreSermon(sermon.slug)">Restore</v-btn>
            <v-btn color="success"  @click="restoreDialog=false" text>Cancel</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-dialog v-model="viewDialog">
        <v-card>
          <v-layout
              id="sermon"
          >
            <v-container class="">
              <div class="header-content ">
                <p class="header-caption">{{computeDate(sermon.published_date)}}</p>
                <h1 class="header-title" >{{sermon.title}}</h1>
                <p class="header-subtitle" v-if="sermon.series">{{sermon.series.title}}</p>
              </div>
              <v-divider></v-divider>
              <div class="d-flex align-center sermon-avatar">
                <div class="sermon-avatar-img"
                     :style="{
                        backgroundImage:`url(${computeImageUrl(sermon.author.avatar)})`
                     }"
                ></div>
                <div class="sermon-avatar-name">
                  <h4>{{sermon.author.name}}</h4>
                  <p>{{sermon.author.title}}</p>
                </div>
              </div>
            </v-container>
          </v-layout>
          <v-layout
              class="content"
          >
            <v-container>
              <div v-html="sermon.body"></div>
            </v-container>
          </v-layout>
          <v-card-actions>
            <v-btn @click="viewDialog=false" dark>close</v-btn>
            <v-btn @click="routeToPastor(sermon.author.slug)" text>Pastor</v-btn>
            <v-btn v-if="sermon.series" @click="routeToSeriesView(sermon.series.slug)" text>Series</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </v-col>

</template>

<script>

import {API} from "../config";

export default {
  props:['sermon','deleteStatus', 'restoreStatus'],

  data: () => ({
      deleteDialog:false,
      restoreDialog:false,
      viewDialog:false

    }),
    components:{

    },
    created(){

    },
    mounted(){

    },
    computed: {

    },
    watch: {
      deleteStatus:function () {
        this.deleteDialog=false
      },
      restoreStatus:function () {
        this.restoreDialog=false
      },
    },
    methods:{
        computeDate:function (date) {
            return date.month + " " + date.day + ", " + date.year
        },
        routeToSeriesView(slug){
          this.$router.push({name:"series-view", params:{slug:slug}})
        },
        routeToPastor(slug){
          this.$router.push({name:"pastor", params:{slug:slug}})
        },
        routeToViewSermon(slug){
            this.$router.push({name:"sermon-view", params:{slug:slug}})
        },
        routeToEditSermon(slug){
            this.$router.push({name:"sermon-edit", params:{slug:slug}})
        },
        computeImageUrl(url){
            return API.URL+url
        },
        trashSermon(slug){
          this.$store.dispatch('SermonTrash',{
            slug:slug
          })
        },
        restoreSermon(slug){
          this.$store.dispatch('SermonRestore',{
            slug:slug
          })
        },
        destroySermon(slug){
          this.$store.dispatch('SermonDestroy',{
            slug:slug
          })
        },
    }

}
</script>
