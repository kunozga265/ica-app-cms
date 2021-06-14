<style scoped lang="scss">
@import "../../../sass/variables";

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
        padding: 70px 0 0;
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
                        <p class="header-caption">{{seriesCompound.series.duration?seriesCompound.series.duration:"Unpublished"}}</p>
                        <h1 class="header-title">{{seriesCompound.series.title}}</h1>
                        <div class="header-description">
                            <span>DESCRIPTION</span>
                            <div>{{seriesCompound.series.description}}</div>
                        </div>
<!--                      <div>-->
<!--                        <v-btn icon color="success" @click="routeToEditSeries(seriesCompound.series.slug)"><v-icon>mdi-pencil</v-icon></v-btn>-->
<!--&lt;!&ndash;                        <v-btn icon color="error" @click="deleteDialog=true" :disabled="deleteStatus===1"><v-icon>mdi-delete</v-icon></v-btn>&ndash;&gt;-->
<!--                        <v-btn icon color="error" @click="deleteDialog=true"><v-icon>mdi-delete</v-icon></v-btn>-->
<!--                      </div>-->
                    </div>
                </v-container>
            </v-layout>
            <v-layout
                class="content"
                v-if="(seriesCompound.sermons).length!==0"
            >
                <v-container>
                    <p class="content-heading">{{ computeSermonsCount(seriesCompound.series.sermon_count) }}</p>
                    <v-row>
                      <sermon
                          v-for="sermon in seriesCompound.sermons"
                          :key="sermon.id"
                          :sermon="sermon"
                          :delete-status="sermonsDeleteStatus"
                          :restore-status="sermonsRestoreStatus"
                      ></sermon>
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
<!--      <v-dialog v-model="deleteDialog" max-width="400">-->
<!--        <v-card>-->
<!--          <v-card-title>Are you sure?</v-card-title>-->
<!--          <v-card-text>You are about to delete this series. This series will be trashed and can later be restored. All sermons under this series will be detached from this series.</v-card-text>-->
<!--          <v-card-actions>-->
<!--            <v-btn :disabled="seriesDeleteStatus===1" color="error" @click="trashSeries">Delete</v-btn>-->
<!--            <v-btn color="error"  @click="deleteDialog=false" text>Cancel</v-btn>-->
<!--          </v-card-actions>-->
<!--        </v-card>-->
<!--      </v-dialog>-->
      <v-snackbar
          v-model="snackbar"
      >
        {{snackbarMessage}}
      </v-snackbar>

    </div>
</template>

<script>
import {API} from "../../config";
import Sermon from "../../components/Sermon";

export default {
    props:['slug'],
    data: () => ({
      snackbar:false,
      snackbarMessage:"",
      deleteDialog:false
    }),
    components:{
      Sermon

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
          },
        sermonsDeleteStatus(){
          return this.$store.getters.getSermonsDeleteStatus
        },
        sermonsRestoreStatus(){
          return this.$store.getters.getSermonsRestoreStatus
        },
        // seriesDeleteStatus(){
        //   return this.$store.getters.getSeriesDeleteStatus
        // },
        // seriesRestoreStatus(){
        //   return this.$store.getters.getSeriesRestoreStatus
        // },
    },
    watch: {
        slug:function () {
            this.$store.dispatch('SermonShow',{
                slug:this.slug
            })
        },
      sermonsDeleteStatus:function () {
        switch (this.sermonsDeleteStatus) {
          case 1:
            this.snackbarMessage="Deleting sermon";
            break;
          case 2:
            this.snackbarMessage="Deleted successfully.";
            this.$router.push("/series");
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
      // seriesDeleteStatus:function () {
      //   switch (this.seriesDeleteStatus) {
      //     case 1:
      //       this.snackbarMessage="Deleting series";
      //       break;
      //     case 2:
      //       this.snackbarMessage="Deleted successfully.";
      //       this.$router.push("/series");
      //       break;
      //     case 3:
      //       this.snackbarMessage="Deleting was unsuccessful.";
      //       break;
      //     case 4:
      //       this.snackbarMessage="Deleting was unsuccessful. Check your connection.";
      //       break;
      //     default:
      //       break;
      //   }
      //   this.snackbar=true;
      // },
    },
    methods:{
        computeImageUrl(url){
            return API.URL+url
        },
        routeToSermon(slug){
            this.$router.push({name:"sermon", params:{slug:slug}})
        },
        // routeToEditSeries(slug){
        //   this.$router.push({name:"series-edit", params:{slug:slug}})
        // },
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
      // trashSeries(){
      //     this.$store.dispatch("SeriesTrash",{
      //       slug:this.slug
      //     })
      // }
    }

}
</script>
