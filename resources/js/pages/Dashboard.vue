<style scoped lang="scss">
@import "../../sass/_variables.scss";

.content-card{
  &:hover{
    cursor: pointer;
  }
}

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
    <div>
      <v-layout class="content">
        <v-container>
          <h1 class="header-title">Dashboard</h1>
          <div class="content-spacer"></div>
          <div v-if="scheduledSermonsLoadStatus===1">
            <div class="content-spacer"></div>
            <div class="d-flex justify-center">
              <v-progress-circular indeterminate></v-progress-circular>
            </div>
          </div>
          <div class="compound-view-container" v-else>
            <p class="content-heading">Scheduled Sermons</p>
            <v-row>
              <sermon
                  v-for="sermon in scheduledSermons"
                  :key="sermon.id"
                  :sermon="sermon"
                  :delete-status="sermonsDeleteStatus"
                  :restore-status="sermonsRestoreStatus"
              ></sermon>
            </v-row>
            <div class="content-spacer"></div>
          </div>
        </v-container>
      </v-layout>
      <v-layout class="content" style="background-color: #fafafa">
        <v-container>
          <div class="compound-view-container">
            <p class="content-heading">Most Viewed Sermons</p>

            <div v-if="sermonsLoadStatus===1">
              <div class="content-spacer"></div>
              <div class="d-flex justify-center">
                <v-progress-circular indeterminate></v-progress-circular>
              </div>
            </div>
            <v-row v-else>
              <v-col
                  cols="12"
                  v-for="view in views"
                  :key="view.id"
                  @click="viewSermon(view.sermon)"
              >
                <div class="content-card">
                  <v-divider></v-divider>
                  <p class="content-title">{{ view.sermon.title }}</p>
                  <p class="content-subtitle" v-if="view.sermon.series != null">{{ view.sermon.series.title }}</p>
                  <p class="content-caption">{{computeDate(view.sermon.published_date)+ " | " + view.sermon.author.name + " | " + computeViewsCount(view.count)}}</p>
                </div>
              </v-col>
            </v-row>
          </div>
          <v-pagination
              v-model="page"
              :length="lastPage"
              v-show="lastPage!==0"
          ></v-pagination>
        </v-container>
      </v-layout>
      <v-snackbar
          v-model="snackbar"
      >
        {{snackbarMessage}}
      </v-snackbar>
      <v-dialog v-model="viewDialog" v-if="sermon">
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
            <v-btn @click="viewDialog=false; sermon=null" dark>close</v-btn>
            <v-btn @click="routeToPastor(sermon.author.slug)" text>Pastor</v-btn>
            <v-btn v-if="sermon.series" @click="routeToSeriesView(sermon.series.slug)" text>Series</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
</template>

<script>

import {API} from "../config";
import Sermon from "../components/Sermon";

export default {
    data: () => ({
      viewDialog:false,
      sermon:null,
      page:1,
      snackbar:false,
      snackbarMessage:"",
    }),
    components:{
      Sermon
    },
    created(){
      window.scrollTo(0,0)
      this.$store.dispatch("SermonsScheduled")
      this.$store.dispatch('SermonsIndex',{
        filter:"Views",
        page:1
      })
    },
    mounted(){

    },
    computed: {
        views:function(){
          //sermons embedded in view object
            let views=this.$store.getters.getSermons

            if (views){
                return views
            }else
                return []
        },
        sermonsLoadStatus(){
          return this.$store.getters.getSermonsLoadStatus
        },
        lastPage(){
          return this.$store.getters.getSermonsLastPage
        },
        scheduledSermons:function(){
            let sermons=this.$store.getters.getScheduledSermons

            if (sermons){
                return sermons
            }else
                return []
        },
        scheduledSermonsLoadStatus(){
            return this.$store.getters.getScheduledSermonsLoadStatus
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

      sermonsDeleteStatus(){
        return this.$store.getters.getSermonsDeleteStatus
      },
      sermonsRestoreStatus(){
        return this.$store.getters.getSermonsRestoreStatus
      },
    },
    watch: {
      page:function () {
        this.$store.dispatch('SermonsIndex',{
          filter:"Views",
          page:this.page
        })
      },
      sermonsDeleteStatus:function () {
        switch (this.sermonsDeleteStatus) {
          case 1:
            this.snackbarMessage="Deleting sermon";
            break;
          case 2:
            this.snackbarMessage="Deleted successfully.";
            this.$store.dispatch("SermonsScheduled")
            break;
          case 3:
            this.snackbarMessage="Deleting was unsuccessful.";
            break;
          case 4:
            this.snackbarMessage="Deleting was unsuccessful. Check your connection.";
            break;
          default:
            break;
        }
        this.snackbar=true;
      },
      sermonsRestoreStatus:function () {
        switch (this.sermonsRestoreStatus) {
          case 1:
            this.snackbarMessage="Restoring sermon";
            break;
          case 2:
            this.snackbarMessage="Restored successfully.";
            this.$store.dispatch("SermonsScheduled")
            break;
          case 3:
            this.snackbarMessage="Restoring was unsuccessful.";
            break;
          case 4:
            this.snackbarMessage="Restoring was unsuccessful. Check your connection.";
            break;
          default:
            break;
        }
        this.snackbar=true;
      },


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
      computeViewsCount(count){
            switch (count){
                case 1:
                    return count + " View"
                default:
                    return count + " Views"
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
        routeToPastor(slug){
          this.$router.push({name:"pastor", params:{slug:slug}})
        },
        computeImageUrl(url){
            return API.URL+url
        },
      viewSermon(sermon){
        this.sermon=sermon
        this.viewDialog=true
      }
    },
}

</script>
