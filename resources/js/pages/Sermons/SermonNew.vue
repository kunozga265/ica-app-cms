<style scoped lang="scss">
@import "../../../sass/variables";

.content-wrapper{
  //padding: 36px;
  //background-color: white;
  //border-radius: 5px;
  margin: 36px 0;
  //box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
}



@media (min-width: 600px) {


}
@media (min-width: 768px) {


}
@media (min-width: 960px) {

}
@media (min-width: 1200px) {

}


</style>

<template>
    <div>
<!--      <v-layout>-->
<!--        <v-container class="">-->

<!--          <div class="header-content ">-->
<!--            <h1 class="header-title">New Sermon</h1>-->
<!--&lt;!&ndash;            <p class="header-caption">New Sermon</p>&ndash;&gt;-->
<!--          </div>-->
<!--&lt;!&ndash;          <v-divider></v-divider>&ndash;&gt;-->
<!--        </v-container>-->
<!--      </v-layout>-->
      <v-layout class="content">
        <v-container>
          <h1 class="header-title">Post</h1>
<!--          <p class="">New Sermon</p>-->
          <p class="content-heading" >New Sermon</p>
          <div class="content-wrapper">
            <v-row>
              <v-col
                  cols="12"
                  sm="6"
              >
                <v-text-field
                    v-model="title"
                    label="Title"
                    clearable
                    required
                    :rules="[rules.required]"
                    filled
                    hint="Required"
                    persistent-hint
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  sm="6"
              >
                <v-text-field
                    v-model="subtitle"
                    label="Subtitle"
                    hint="Optional"
                    clearable
                    filled
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  sm="6"
              >
                <v-autocomplete
                    label="Author"
                    v-model="author_id"
                    :items="authors"
                    item-text="name"
                    item-value="id"
                    filled
                    :rules="[rules.required]"
                    hint="Required"
                    persistent-hint
                >
                  <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content v-text="data.item"></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-avatar>
                        <img :src="computeImageUrl(data.item.avatar)" alt="">
                      </v-list-item-avatar>
                      <v-list-item-content>
                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                        <v-list-item-subtitle v-html="data.item.title"></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-col>
              <v-col
                  cols="12"
                  sm="6"
              >
                <v-autocomplete
                    label="Series"
                    v-model="series_id"
                    :items="seriesOptions"
                    item-text="title"
                    item-value="id"
                    filled
                    hint="Optional"
                    clearable
                ></v-autocomplete>
              </v-col>
              <v-col
                  cols="12"
              >
                <v-text-field
                    v-model="video_url"
                    label="Youtube URL"
                    hint="Optional"
                    clearable
                    filled
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
              >
                <ckeditor :editor="editor" v-model="body" :config="editorConfig"></ckeditor>
              </v-col>
              <v-col
                  cols="12"
                  sm="6"
              >
                <v-radio-group
                    v-model="publish"
                    row
                    mandatory
                >
                  <v-radio
                      label="Publish Now"
                      value="now"
                  ></v-radio>
                  <v-radio
                      label="Schedule"
                      value="schedule"
                  ></v-radio>
                </v-radio-group>
              </v-col>
              <v-col
                  cols="12"
                  sm="6"
                  v-show="publish==='schedule'"
              >
                <v-menu
                    v-model="menu"
                    close-on-content-click
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                >
                  <template v-slot:activator="{on, attrs}">
                    <v-text-field
                        v-model="date"
                        label="Scheduled Date"
                        prepend-inner-icon="mdi-calendar"
                        v-bind="attrs"
                        v-on="on"
                        filled
                    ></v-text-field>
                  </template>
                  <v-date-picker
                      v-model="date"
                      @input="menu=false"
                  ></v-date-picker>

                </v-menu>
              </v-col>
              <v-col
                  cols="12"
                  class="text-xs-center"
              >
                <v-btn :disabled="sermonsStoreStatus===1" dark @click="postSermon">Post</v-btn>
              </v-col>
            </v-row>
          </div>
        </v-container>
      </v-layout>
      <v-snackbar
          v-model="snackbar"
      >
        {{snackbarMessage}}
      </v-snackbar>
    </div>
</template>

<script>

import {API} from "../../config";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic"

export default {
    data: () => ({
      title:"",
      subtitle:"",
      author_id:null,
      series_id:null,
      video_url:"",
      body:"",
      publish:"now",

      menu:false,
      date: new Date().toISOString().substr(0,10),

      editor:ClassicEditor,
      editorConfig:{
        toolbar:['bold','italic','link','|','bulletedList','numberedList','|','undo','redo']
      },
      rules: {
        required: value => !!value || 'Required',
      },
      snackbar:false,
      snackbarMessage:"",
    }),
    components:{

    },
    created(){
        window.scrollTo(0,0)
      this.$store.dispatch("AuthorsIndex",{
        filter:"All"
      })
      this.$store.dispatch("SeriesOptions")

    },
    mounted(){


    },
    computed: {
      authors(){
        let unfiltered=this.$store.getters.getAuthors
        let filtered=[]
        let icaPastorHeader=true
        let otherMinistersHeader=true

        if (unfiltered){
          for (let item in unfiltered){

            if (unfiltered[item].ica_pastor==1) {

              if(icaPastorHeader) {
                filtered.push({header: 'ICA Pastors'})
                icaPastorHeader=false
              }

              filtered.push(unfiltered[item])
            }
          }
          for (let item in unfiltered){

            if (unfiltered[item].ica_pastor==0) {

              if(otherMinistersHeader) {
                filtered.push({header: 'Other Ministers'})
                otherMinistersHeader=false
              }

              filtered.push(unfiltered[item])
            }
          }

          return filtered
        }else
          return filtered
      },
      authorsLoadStatus(){
        return this.$store.getters.getAuthorsLoadStatus
      },
      seriesOptions(){
        let results= this.$store.getters.getSeriesOptions
        if (results)
          return results
        else
          return []
      },
      seriesOptionsStatus(){
        return this.$store.getters.getSeriesOptionsStatus
      },
      sermonsStoreStatus(){
        return this.$store.getters.getSermonsStoreStatus
      },
      validation(){
        if((this.title).length===0){
          this.snackbarMessage="Please fill the Title"
          return false
        }
        else if((this.author_id).length===0){
          this.snackbarMessage="Please fill the Author"
          return false
        }
        else if((this.body).length===0){
          this.snackbarMessage="Please fill the Body"
          return false
        }else
          return true
      },
      published_at(){
        return this.publish==="now"?null:this.getTimestamp(this.date)
      }

    },
    watch: {
      sermonsStoreStatus:function () {
        switch (this.sermonsStoreStatus) {
          case 1:
            this.snackbarMessage="Posting sermon";
            break;
          case 2:
            this.snackbarMessage="Posted successfully.";
            this.$router.push('/sermons');
            break;
          case 3:
            this.snackbarMessage="Posting was unsuccessful.";
            break;
          case 4:
            this.snackbarMessage="Posting was unsuccessful. Check your connection.";
            break;
          default:
            break;
        }
        this.snackbar=true;
        }
    },
    methods:{
      computeImageUrl(url){
        return API.URL+url
      },
      postSermon(){
        if(!this.validation)
          this.snackbar=true
        else{
          this.$store.dispatch("SermonStore",{
            title:this.title,
            subtitle:this.subtitle,
            body:this.body,
            author_id:this.author_id,
            series_id:this.series_id,
            video_url:this.video_url,
            published_at:this.published_at
          })
        }
      },
      getTimestamp (date) {
        return (new Date(date).getTime())/1000
      },
    }
}
</script>
