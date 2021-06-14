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
          <p class="content-heading" >New Pastor</p>
          <div class="content-wrapper">
            <v-row>
              <v-col
                  cols="12"
                  sm="6"
              >
                <v-text-field
                    v-model="name"
                    label="Name"
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
                    v-model="suffix"
                    label="Suffix"
                    clearable
                    filled
                    hint="Optional"
                ></v-text-field>
              </v-col>
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
                <v-switch
                    v-model="ica_pastor"
                    label="ICA Pastor"
                ></v-switch>
              </v-col>
              <v-col
                  cols="12"
              >
                Biography
                <ckeditor  :editor="editor" v-model="biography" :config="editorConfig"></ckeditor>
              </v-col>
              <v-col cols="12">
                <upload-button
                    ref="button"
                    @file-update="generateImageCode"
                    title="Select Image"
                >
                  <template slot="icon-left">
                    <v-icon  left>mdi-attach-file</v-icon>
                  </template>
                </upload-button>
              </v-col>
              <v-col
                  cols="12"
                  class="text-xs-center"
              >
                <v-btn :disabled="pastorStoreStatus===1" dark @click="postPastor">Post</v-btn>
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
import UploadButton from "vuetify-upload-button"

export default {
    data: () => ({
      title:"",
      biography:"",
      ica_pastor:true,
      name:"",
      suffix:"",
      avatar:"",

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
      UploadButton
    },
    created(){
        window.scrollTo(0,0)
    },
    mounted(){


    },
    computed: {
      validation(){
        if((this.name).length===0){
          this.snackbarMessage="Please fill the Name"
          return false
        }
        else if((this.title).length===0){
          this.snackbarMessage="Please fill the Title"
          return false
        }
        else if((this.biography).length===0) {
          this.snackbarMessage = "Please fill the Body"
          return false
        }else
          return true
      },
      pastorStoreStatus(){
        return this.$store.getters.getAuthorsStoreStatus
      }

    },
    watch: {
      pastorStoreStatus:function () {
        switch (this.pastorStoreStatus) {
          case 1:
            this.snackbarMessage="Posting pastor";
            break;
          case 2:
            this.snackbarMessage="Posted successfully.";
            this.$router.push('/pastors');
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
      postPastor(){
        if(!this.validation)
          this.snackbar=true
        else{
          this.$store.dispatch("AuthorsStore",{
            name:this.name,
            suffix:this.suffix,
            title:this.title,
            avatar:this.avatar,
            ica_pastor:this.ica_pastor,
            biography:this.biography,
          })
        }
      },
      generateImageCode(file) {
        const reader = new FileReader();
        if (file) {
          reader.readAsDataURL(file);
          reader.onload = (e) => {
            this.avatar=e.target.result
          };
        }
      }
    }
}
</script>
