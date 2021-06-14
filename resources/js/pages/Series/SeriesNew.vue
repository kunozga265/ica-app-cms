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
          <h1 class="header-title">Post</h1>
<!--          <p class="">New Sermon</p>-->
          <p class="content-heading" >New Series</p>
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
                <v-btn :disabled="seriesStoreStatus===1" dark @click="postSermon">Post</v-btn>
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
    },
    mounted(){


    },
    computed: {
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
      seriesStoreStatus(){
        return this.$store.getters.getSeriesStoreStatus
      }

    },
    watch: {
      seriesStoreStatus:function () {
        switch (this.seriesStoreStatus) {
          case 1:
            this.snackbarMessage="Posting series";
            break;
          case 2:
            this.snackbarMessage="Posted successfully.";
            this.$router.push('/series');
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
      postSermon(){
        if(!this.validation)
          this.snackbar=true
        else{
          this.$store.dispatch("SeriesStore",{
            title:this.title,
            description:this.description,
          })
        }
      },
    }
}
</script>
