<style scoped lang="scss">
@import "../../sass/_variables.scss";

</style>

<template>
    <div>
        <v-layout class="content">
            <v-container>
              <h1 class="header-title">Sermons</h1>
              <v-select
                  v-model="selectedOption"
                  :items="options"
                  solo
              ></v-select>
<!--            </v-container>-->
<!--        </v-layout>-->
<!--        <v-layout class="content">-->
<!--            <v-container>-->
              <div
                  class="compound-view-container"
                  v-for="(sermonCompound,index) in sermons"
                  :index="index"
              >
                <p class="content-heading">{{ sermonCompound.month + " " + sermonCompound.year }}</p>
                <v-row>
                  <v-col
                      cols="12"
                      v-for="sermon in sermonCompound.sermons"
                      :key="sermon.id"
                  >
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
                                <v-btn icon color="info" @click="routeToViewSermon(sermon.slug)"><v-icon>mdi-eye</v-icon></v-btn>
                              </li>
                              <li>
                                <v-btn icon color="success" @click="routeToEditSermon(sermon.slug)"><v-icon>mdi-pencil</v-icon></v-btn>
                              </li>
                              <li>
                                <v-btn icon color="error" @click="deletableSlug(sermon.slug)" :disabled="sermonsDeleteStatus===1"><v-icon>mdi-delete</v-icon></v-btn>
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
                          <v-card-text>You are about to delete this sermon. This sermon will be trashed and can later be restore.</v-card-text>
                          <v-card-actions>
                            <v-btn color="error" @click="deleteSermon">Delete</v-btn>
                            <v-btn color="error"  @click="deleteDialog=false" text>Cancel</v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                  </div>
                  </v-col>
                </v-row>
              </div>
              <v-pagination
                  v-model="page"
                  :length="lastPage"
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

import {API} from "../config";

export default {
    data: () => ({
      options:["Published","Scheduled","Drafts","Trashed"],
      selectedOption:"Published",
      page:1,
      deleteDialog:false,
      snackbar:false,
      snackbarMessage:"",
      deleteSlug:null
    }),
    components:{

    },
    created(){
      window.scrollTo(0,0)
      this.$store.dispatch('SermonsIndex',{
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
      lastPage(){
        return this.$store.getters.getSermonsLastPage
      }
    },
    watch: {
      page:function () {
        this.$store.dispatch("SermonsIndex",{
          page:this.page
        })
      },

      sermonsDeleteStatus:function () {
        switch (this.sermonsDeleteStatus) {
          case 1:
            this.deleteSlug=null
            this.deleteDialog=false
            this.snackbarMessage="Deleting sermon";
            break;
          case 2:
            this.snackbarMessage="Deleted successfully.";
            this.$store.dispatch('SermonsIndex',{
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
      deleteDialog:function () {
        if (this.deleteDialog===false)
          this.deleteSlug=null
      }


    },
    methods:{
        // loadMore(){
        //     this.$store.dispatch('AppendSermons')
        // },
        computeDate:function (date) {
            return date.month + " " + date.day + ", " + date.year
        },
        routeToViewSermon(slug){
            this.$router.push({name:"sermon-view", params:{slug:slug}})
        },
        routeToEditSermon(slug){
            this.$router.push({name:"sermon-edit", params:{slug:slug}})
        },
        routeToNewSermon(){
            this.$router.push({name:"sermon-new"})
        },
        computeImageUrl(url){
            return API.URL+url
        },
        deleteSermon(){
          if(this.deleteSlug!==null){
            this.$store.dispatch('SermonDestroy',{
              slug:this.deleteSlug
            })
            console.log(this.deleteSlug)
          }
        },
        deletableSlug(slug){
          this.deleteDialog=true
          this.deleteSlug=slug
        }
    }

}
</script>
