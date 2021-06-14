<style scoped lang="scss">
@import "../../../sass/variables";
.compound-view-container{
  .col-12:hover{
    cursor: pointer;
  }
}

</style>

<template>
    <div>
        <v-layout class="content">
            <v-container>
                <h1 class="header-title">Series</h1>
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
                    placeholder="Search Series"
                    append-outer-icon="mdi-filter-menu"
                    prepend-inner-icon="mdi-magnify"
                    @click:append-outer="searchable=!searchable"
                    @click:prepend-inner="searchSeries"
                    v-on:keyup.enter="searchSeries"
                ></v-text-field>
                <div  v-if="seriesLoadStatus===1">
                    <div class="content-spacer"></div>
                    <div class="d-flex justify-center">
                        <v-progress-circular indeterminate></v-progress-circular>
                    </div>
                </div>
                <div
                    v-else-if="seriesLoadStatus===2"
                    class="compound-view-container"

                >
                  <v-row>
                        <series
                            v-for="singleSeries in series"
                            :key="singleSeries.id"
                            :series="singleSeries"
                            :delete-status="seriesDeleteStatus"
                            :restore-status="seriesRestoreStatus"
                        ></series>

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
                @click="routeToNewSeries"
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
import Series from "../../components/Series";

export default {
    data: () => ({
      options:["Published","Unpublished","Trashed"],
      selectedOption:"Published",
      page:1,
      searchable:false,
      query:"",
      snackbar:false,
      snackbarMessage:"",
    }),
    components:{
      Series
    },
    created(){
        window.scrollTo(0,0)
        this.$store.dispatch('SeriesIndex',{
          filter:this.selectedOption,
          page:1
        })
    },
    mounted(){

    },
    computed: {
        series:function(){
            let filtered=this.$store.getters.getSeries

            if(filtered)
              return filtered
            else
              return []
        },
        seriesLoadStatus(){
            return this.$store.getters.getSeriesLoadStatus
        },
        seriesDeleteStatus(){
            return this.$store.getters.getSeriesDeleteStatus
        },
        seriesRestoreStatus(){
            return this.$store.getters.getSeriesRestoreStatus
        },
        lastPage(){
          return this.$store.getters.getSeriesLastPage
        }
    },
    watch: {
      page:function () {
        if(this.searchable){
          this.$store.dispatch("SeriesIndex", {
            filter: "Search",
            query: this.query,
            page:this.page
          })
        }else{
          this.$store.dispatch("SeriesIndex",{
            filter:this.selectedOption,
            page:this.page
          })
        }
      },

      searchable:function(){
        if(this.searchable){
          this.$store.dispatch("SeriesClear")
        }else{
          this.$store.dispatch("SeriesIndex",{
            filter:this.selectedOption,
            page:1
          })
        }
      },

      selectedOption:function(){
        this.page=1
        this.$store.dispatch("SeriesIndex",{
          filter:this.selectedOption,
          page:1
        })
      },

      seriesDeleteStatus:function () {
        switch (this.seriesDeleteStatus) {
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
      seriesRestoreStatus:function () {
        switch (this.seriesRestoreStatus) {
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
        routeToNewSeries(){
            this.$router.push({name:"series-new"})
        },
        searchSeries(){
          if (this.query.length!==0) {
            this.$store.dispatch("SeriesIndex", {
              filter: "Search",
              query: this.query,
              page: 1
            })
          }
        }

    }
}
</script>
