<style scoped lang="scss">

.pastor-card{
    position: relative;
    padding: 0 0 0;

    .pastor-card-content{
      padding-right: 126px;
    }

    .content-image{
        position: absolute;
        right: 36px;
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
  <v-col cols="12">
      <div class="pastor-card">
          <v-divider></v-divider>
          <div class="content-image"
               :style="{
                  backgroundImage:`url(${computeImageUrl(author.avatar)})`
               }"
          ></div>
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
                <li v-if="!author.trashed">
                  <v-btn icon color="info" @click="routeToAuthorView"><v-icon>mdi-eye</v-icon></v-btn>
                </li>
                <li v-if="!author.trashed">
                  <v-btn icon color="success" @click="routeToEditAuthor"><v-icon>mdi-pencil</v-icon></v-btn>
                </li>
                <li>
                  <v-btn icon color="error" @click="deleteDialog=true" :disabled="deleteStatus===1"><v-icon>mdi-delete</v-icon></v-btn>
                </li>
                <li v-if="author.trashed">
                  <v-btn icon color="success" @click="restoreDialog=true" :disabled="restoreStatus===1"><v-icon>mdi-backup-restore</v-icon></v-btn>
                </li>
              </ul>
            </v-list>
          </v-menu>
        </div>
          <div class="pastor-card-content">
              <p class="content-title">{{author.name}}</p>
              <p class="content-description">{{ author.title }}</p>
              <p class="sermon-count">{{ computeSermonsCount(author.sermon_count)}}</p>
          </div>
      </div>
    <v-dialog v-model="deleteDialog" max-width="400">
      <v-card>
        <v-card-title>Are you sure?</v-card-title>
        <v-card-text v-if="author.trashed">You are about to permanently delete this pastor. This pastor will not be recoverable.</v-card-text>
        <v-card-text v-else>You are about to delete this pastor. This pastor will be trashed and can later be restored. However, all sermons under this pastor will be permanently deleted.</v-card-text>
        <v-card-actions>
          <v-btn :disabled="deleteStatus===1" v-if="author.trashed" color="error" @click="destroyAuthor">Delete</v-btn>
          <v-btn :disabled="deleteStatus===1" v-else color="error" @click="trashAuthor">Delete</v-btn>
          <v-btn color="error"  @click="deleteDialog=false" text>Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-if="author.trashed" v-model="restoreDialog" max-width="400">
      <v-card>
        <v-card-title>Are you sure?</v-card-title>
        <v-card-text>You are about to restore this pastor.</v-card-text>
        <v-card-actions>
          <v-btn :disabled="restoreStatus===1" color="success" @click="restoreAuthor">Restore</v-btn>
          <v-btn color="success"  @click="restoreDialog=false" text>Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-col>
</template>

<script>
import {API} from "../config";

export default {
  props:["author","deleteStatus","restoreStatus"],
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
      // deleteStatus:function () {
      //   switch (this.deleteStatus) {
      //     case 1:
      //       this.snackbarMessage="Deleting author";
      //       break;
      //     case 2:
      //       this.snackbarMessage="Deleted successfully.";
      //       this.$store.dispatch("SeriesIndex",{
      //         filter:this.selectedOption,
      //         page:this.page
      //       })
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
      // restoreStatus:function () {
      //   switch (this.restoreStatus) {
      //     case 1:
      //       this.snackbarMessage="Restoring series";
      //       break;
      //     case 2:
      //       this.snackbarMessage="Restored successfully.";
      //       this.$store.dispatch("SeriesIndex",{
      //         filter:this.selectedOption,
      //         page:this.page
      //       })
      //       break;
      //     case 3:
      //       this.snackbarMessage="Restoring was unsuccessful.";
      //       break;
      //     case 4:
      //       this.snackbarMessage="Restoring was unsuccessful. Check your connection.";
      //       break;
      //     default:
      //       break;
      //   }
      //   this.snackbar=true;
      // },
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
      routeToPastor(){
          this.$router.push({name:"pastor", params:{slug:this.author.slug}})
      },
      computeImageUrl(url){
          return API.URL+url
      },
      routeToAuthorView(){
        if (!this.author.trashed)
          this.$router.push({name:"pastor-view", params:{slug:this.author.slug}})
      },
      routeToEditAuthor(){
        this.$router.push({name:"pastor-edit", params:{slug:this.author.slug}})
      },
      trashAuthor(){
        this.$store.dispatch("AuthorTrash",{
          slug:this.author.slug
        })
      },
      destroyAuthor(){
        this.$store.dispatch("AuthorDestroy",{
          slug:this.author.slug
        })
      },
      restoreAuthor(){
        this.$store.dispatch("AuthorRestore",{
          slug:this.author.slug
        })
      }
    }
}
</script>
