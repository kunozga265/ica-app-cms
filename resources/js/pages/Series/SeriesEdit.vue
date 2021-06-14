<style scoped lang="scss">
@import "../../../sass/variables";

.content-wrapper{
  margin: 36px 0;
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
      <v-layout class="content">
        <v-container>
          <h1 class="header-title">Update</h1>
<!--          <p class="">New Sermon</p>-->
          <p class="content-heading" >Edit Series</p>
          <div class="content-wrapper">
            <v-row>
              <v-col
                  cols="12"
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
              >
                <ckeditor :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
              </v-col>
              <v-col
                  cols="12"
                  class="text-xs-center"
              >
                <v-btn :disabled="seriesUpdateStatus===1" dark @click="updateSeries">Update</v-btn>
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

import ClassicEditor from "@ckeditor/ckeditor5-build-classic"

export default {
    props:["slug"],
    data: () => ({
      title:"",
      description:"",

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
      this.$store.dispatch('SeriesShow',{
        slug:this.slug,
        filter:"Filter"
      })
    },
    mounted(){


    },
    computed: {
      series(){
        return (this.$store.getters.getSingleSeries).series
      },
      seriesLoadStatus(){
        return this.$store.getters.getSingleSeriesLoadStatus
      },
      validation(){
        if((this.title).length===0){
          this.snackbarMessage="Please fill the Title"
          return false
        }
        else if((this.description).length===0) {
          this.snackbarMessage = "Please fill the Body"
          return false
        }else
          return true
      },
      seriesUpdateStatus(){
        return this.$store.getters.getSeriesUpdateStatus
      },

    },
    watch: {
      seriesLoadStatus:function () {
        switch (this.seriesLoadStatus) {
          case 1:
            break;
          case 2:
            this.title=this.series.title
            this.description=this.series.description
            break;
          case 3:
            break;
          case 4:
            break;
          default:
            break;
        }
      },
      seriesUpdateStatus:function () {
        switch (this.seriesUpdateStatus) {
          case 1:
            this.snackbarMessage="Updating series";
            break;
          case 2:
            this.snackbarMessage="Updated successfully.";
            this.$router.push('/series');
            break;
          case 3:
            this.snackbarMessage="Updating was unsuccessful.";
            break;
          case 4:
            this.snackbarMessage="Updating was unsuccessful. Check your connection.";
            break;
          default:
            break;
        }
        this.snackbar=true;
        }
    },
    methods:{
      updateSeries(){
        if(!this.validation)
          this.snackbar=true
        else{
          this.$store.dispatch("SeriesUpdate",{
            slug:this.slug,
            title:this.title,
            description:this.description,
          })
        }
      },
    }
}
</script>
