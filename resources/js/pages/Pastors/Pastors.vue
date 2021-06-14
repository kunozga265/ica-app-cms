<style scoped lang="scss">
@import "../../../sass/variables";

.pastor-card{
    position: relative;
    padding: 0 0 16px 0;

    .pastor-card-content{
      padding-right: 90px;
    }

    .content-image{
        position: absolute;
        right: 0;
        border-radius: 5px;
        width: 85px;
        height: 85px;
        background-color: #fafafa;
        background-position:center;
        background-repeat:none;
        background-size: cover;
    }

    .v-divider{
        margin-bottom: 16px;
    }

    .sermon-count{
        //position: relative;
    }
}

@media (min-width: 600px) {
    //.pastor-card{
    //    position: relative;
    //    padding: 0 0 60px 0 ;
    //    border: thin solid rgba(0,0,0,.12);
    //    border-radius: 5px;
    //    height: 100%;
    //
    //    .content-image{
    //        position: relative;
    //        width: 100%;
    //        height: 200px;
    //        border-radius: 5px 5px 0 0;
    //    }
    //
    //    .pastor-card-content{
    //        padding: 16px 16px 0 16px;
    //    }

        //.sermon-count{
        //     padding: 0;
        //     margin: 12px 0 0 0;
        //}
    //}
}

@media (min-width: 768px) {
    //.pastor-card {
    //    .content-image {
    //        height: 250px;
    //    }
    //}
}

@media (min-width: 960px) {
    //.pastor-card {
    //    .pastor-card-content{
    //        padding: 24px 24px 0 24px;
    //    }
    //}
}


@media (min-width: 1265px) {
    //.pastor-card {
    //    .content-image {
    //        height: 350px;
    //    }
    //}
}



</style>

<template>
    <div>
      <v-layout
            class="content"
        >
            <v-container>
              <h1 class="header-title">Pastors</h1>
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
                  placeholder="Search Authors"
                  append-outer-icon="mdi-filter-menu"
                  prepend-inner-icon="mdi-magnify"
                  @click:append-outer="searchable=!searchable"
                  @click:prepend-inner="searchAuthors"
                  v-on:keyup.enter="searchAuthors"
              ></v-text-field>
              <div  v-if="pastorsLoadStatus===1">
                  <div class="content-spacer"></div>
                  <div class="d-flex justify-center">
                      <v-progress-circular indeterminate></v-progress-circular>
                  </div>
              </div>
              <div v-else-if="pastorsLoadStatus===2">
                  <v-row>
                      <pastor
                          v-for="pastor in pastors"
                          :key="pastor.id"
                          :author="pastor"
                          :delete-status="authorsDeleteStatus"
                          :restore-status="authorsRestoreStatus"
                      ></pastor>
                  </v-row>
              </div>
<!--              <v-pagination-->
<!--                  v-model="page"-->
<!--                  :length="lastPage"-->
<!--                  v-show="lastPage!==0"-->
<!--              ></v-pagination>-->
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
            @click="routeToNewAuthor"
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
import Pastor from "../../components/Pastor";

export default {
    data: () => ({
      options:["ICA","Other","Trashed"],
      selectedOption:"ICA",
      page:1,
      searchable:false,
      query:"",
      snackbar:false,
      snackbarMessage:"",
    }),
    components:{
      Pastor
    },
    created(){
      window.scrollTo(0,0)
      this.$store.dispatch('AuthorsIndex',{
        filter:this.selectedOption
      })

    },
    mounted(){

    },
    computed: {
        pastors(){
          let filtered=this.$store.getters.getAuthors

          if(filtered)
            return filtered
          else
            return []
        },
        pastorsLoadStatus(){
            return this.$store.getters.getAuthorsLoadStatus
        },
      authorsDeleteStatus(){
          return this.$store.getters.getAuthorsDeleteStatus
      },
      authorsRestoreStatus(){
          return this.$store.getters.getAuthorsRestoreStatus
      }

    },
    watch: {
      searchable:function(){
        if(this.searchable){
          this.$store.dispatch("AuthorsClear")
        }else{
          this.$store.dispatch("AuthorsIndex",{
            filter:this.selectedOption
          })
        }
      },

      selectedOption:function(){
        this.page=1
        this.$store.dispatch("AuthorsIndex",{
          filter:this.selectedOption
        })
      },

      authorsDeleteStatus:function () {
        switch (this.authorsDeleteStatus) {
          case 1:
            this.snackbarMessage="Deleting pastor";
            break;
          case 2:
            this.snackbarMessage="Deleted successfully.";
            this.$store.dispatch("AuthorsIndex",{
              filter:this.selectedOption
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
      authorsRestoreStatus:function () {
        switch (this.authorsRestoreStatus) {
          case 1:
            this.snackbarMessage="Restoring pastor";
            break;
          case 2:
            this.snackbarMessage="Restored successfully.";
            this.$store.dispatch("AuthorsIndex",{
              filter:this.selectedOption
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
        routeToPastor(slug){
            this.$router.push({name:"pastor", params:{slug:slug}})
        },
        computeImageUrl(url){
            return API.URL+url
        },
      searchAuthors(){
        if (this.query.length!==0) {
          this.$store.dispatch("AuthorsIndex", {
            filter: "Search",
            query: this.query,
          })
        }
      },
      routeToNewAuthor(){
          this.$router.push({name:"pastor-new"})
      }
    }
}
</script>
