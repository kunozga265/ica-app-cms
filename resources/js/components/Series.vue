<style scoped lang="scss">


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
              <li v-if="!series.trashed">
                <v-btn icon color="info" @click="routeToSeriesView"><v-icon>mdi-eye</v-icon></v-btn>
              </li>
              <li v-if="!series.trashed">
                <v-btn icon color="success" @click="routeToEditSeries"><v-icon>mdi-pencil</v-icon></v-btn>
              </li>
              <li>
                <v-btn icon color="error" @click="deleteDialog=true" :disabled="deleteStatus===1"><v-icon>mdi-delete</v-icon></v-btn>
              </li>
              <li v-if="series.trashed">
                <v-btn icon color="success" @click="restoreDialog=true" :disabled="restoreStatus===1"><v-icon>mdi-backup-restore</v-icon></v-btn>
              </li>
            </ul>
          </v-list>
        </v-menu>
      </div>
      <div class="content-wrapper">
        <p class="content-caption">{{series.duration?series.duration:"Unpublished"}}</p>
        <p class="content-title">{{ series.title }}</p>
        <p class="content-description">{{ series.description}}</p>
        <p class="sermon-count">{{ computeSermonsCount(series.sermon_count) }}</p>
      </div>
    </div>
    <v-dialog v-model="deleteDialog" max-width="400">
      <v-card>
        <v-card-title>Are you sure?</v-card-title>
        <v-card-text v-if="series.trashed">You are about to permanently delete this series. This series will not be recoverable.</v-card-text>
        <v-card-text v-else>You are about to delete this series. This series will be trashed and can later be restored. All sermons under this series will be detached from this series.</v-card-text>
        <v-card-actions>
          <v-btn :disabled="deleteStatus===1" v-if="series.trashed" color="error" @click="destroySeries">Delete</v-btn>
          <v-btn :disabled="deleteStatus===1" v-else color="error" @click="trashSeries">Delete</v-btn>
          <v-btn color="error"  @click="deleteDialog=false" text>Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-if="series.trashed" v-model="restoreDialog" max-width="400">
      <v-card>
        <v-card-title>Are you sure?</v-card-title>
        <v-card-text>You are about to restore this series.</v-card-text>
        <v-card-actions>
          <v-btn :disabled="restoreStatus===1" color="success" @click="restoreSeries(series.slug)">Restore</v-btn>
          <v-btn color="success"  @click="restoreDialog=false" text>Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-col>
</template>

<script>
import {API} from "../config";

export default {
  props:["series","deleteStatus","restoreStatus"],
    data: () => ({
      deleteDialog:false,
      restoreDialog:false
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
        switch (this.deleteStatus) {
          case 1:
            this.snackbarMessage="Deleting series";
            break;
          case 2:
            this.snackbarMessage="Deleted successfully.";
             this.$store.dispatch("SeriesIndex",{
              filter:this.selectedOption,
              page:this.page
            })
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
      restoreStatus:function () {
        switch (this.restoreStatus) {
          case 1:
            this.snackbarMessage="Restoring series";
            break;
          case 2:
            this.snackbarMessage="Restored successfully.";
             this.$store.dispatch("SeriesIndex",{
              filter:this.selectedOption,
              page:this.page
            })
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
      computeSermonsCount(count){
          switch (count){
              case 1:
                  return count + " Sermon"
              default:
                  return count + " Sermons"
          }
      },
      routeToSeriesView(){
        if (!this.series.trashed)
          this.$router.push({name:"series-view", params:{slug:this.series.slug}})
      },
      routeToEditSeries(){
        this.$router.push({name:"series-edit", params:{slug:this.series.slug}})
      },
      computeImageUrl(url){
          return API.URL+url
      },
      trashSeries(){
        this.$store.dispatch("SeriesTrash",{
          slug:this.series.slug
        })
      },
      destroySeries(){
        this.$store.dispatch("SeriesDestroy",{
          slug:this.series.slug
        })
      },
      restoreSeries(){
        this.$store.dispatch("SeriesRestore",{
          slug:this.series.slug
        })
      }

    }
}
</script>
