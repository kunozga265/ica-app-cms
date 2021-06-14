<style scoped lang="scss">
@import "../../../sass/variables";

</style>

<template>
    <div>
        <v-layout class="content">
            <v-container>
              <h1 class="header-title">Sermons</h1>
              <v-select
                  v-if="!searchable"
                  v-model="selectedOption"
                  :items="options"
                  filled
                  label="Filter by"
                  append-outer-icon="mdi-magnify"
                  @click:append-outer="searchable=!searchable"
              ></v-select>
              <v-text-field
                  v-else
                  v-model="query"
                  filled
                  placeholder="Search Sermons"
                  append-outer-icon="mdi-filter-menu"
                  prepend-inner-icon="mdi-magnify"
                  @click:append-outer="searchable=!searchable"
                  @click:prepend-inner="searchSermons"
                  v-on:keyup.enter="searchSermons"
              ></v-text-field>
              <div  v-if="sermonsLoadStatus===1">
                <div class="content-spacer"></div>
                <div class="d-flex justify-center">
                  <v-progress-circular indeterminate></v-progress-circular>
                </div>
              </div>
              <div
                  class="compound-view-container"
                  v-for="(sermonCompound,index) in sermons"
                  :index="index"
              >
                <p class="content-heading">{{ sermonCompound.month + " " + sermonCompound.year }}</p>
                <v-row>
                  <sermon
                      v-for="sermon in sermonCompound.sermons"
                      :key="sermon.id"
                      :sermon="sermon"
                      :delete-status="sermonsDeleteStatus"
                      :restore-status="sermonsRestoreStatus"
                  ></sermon>
                </v-row>
              </div>
              <v-pagination
                  v-model="page"
                  :length="lastPage"
                  v-show="lastPage!==0"
              ></v-pagination>

            </v-container>
        </v-layout>
      <v-fab-transition>
        <v-btn
            fixed
            right
            bottom
            fab
            color="info"
            dark
            @click="routeToNewSermon"
        ><v-icon >mdi-plus</v-icon></v-btn>
      </v-fab-transition>
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
    data: () => ({
      options:["Published","Scheduled","Trashed"],
      selectedOption:"Published",
      page:1,
      snackbar:false,
      snackbarMessage:"",
      searchable:false,
      query:""
    }),
    components:{
      Sermon
    },
    created(){
      window.scrollTo(0,0)
      this.$store.dispatch('SermonsIndex',{
        filter:this.selectedOption,
        page:1
      })
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
      sermonsDeleteStatus(){
          return this.$store.getters.getSermonsDeleteStatus
      },
      sermonsRestoreStatus(){
          return this.$store.getters.getSermonsRestoreStatus
      },
      lastPage(){
        return this.$store.getters.getSermonsLastPage
      }
    },
    watch: {
      page:function () {
        if(this.searchable){
          this.$store.dispatch("SermonsIndex", {
            filter: "Search",
            query: this.query,
            page:this.page
          })
        }else{
          this.$store.dispatch("SermonsIndex",{
            filter:this.selectedOption,
            page:this.page
          })
        }
      },

      searchable:function(){
        if(this.searchable){
          this.$store.dispatch("SermonsClear")
        }else{
          this.$store.dispatch("SermonsIndex",{
            filter:this.selectedOption,
            page:1
          })
        }
      },

      selectedOption:function(){
        this.page=1
        this.$store.dispatch("SermonsIndex",{
          filter:this.selectedOption,
          page:1
        })
      },

      sermonsDeleteStatus:function () {
        switch (this.sermonsDeleteStatus) {
          case 1:
            this.snackbarMessage="Deleting sermon";
            break;
          case 2:
            this.snackbarMessage="Deleted successfully.";
            this.$store.dispatch('SermonsIndex',{
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
      sermonsRestoreStatus:function () {
        switch (this.sermonsRestoreStatus) {
          case 1:
            this.snackbarMessage="Restoring sermon";
            break;
          case 2:
            this.snackbarMessage="Restored successfully.";
            this.$store.dispatch('SermonsIndex',{
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
      routeToNewSermon(){
        this.$router.push({name:"sermon-new"})
      },
      searchSermons(){
        if (this.query.length!==0) {
          this.$store.dispatch("SermonsIndex", {
            filter: "Search",
            query: this.query,
            page: 1
          })
        }
      }
    }

}
</script>
