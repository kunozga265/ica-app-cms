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
          <p class="content-heading" >Edit Pastor</p>
          <div class="content-wrapper">
            <v-row justify="space-around">
              <v-avatar size="250">
                <img :src="filename">
              </v-avatar>
            </v-row>
            <div class="content-spacer"></div>
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
                <v-btn :disabled="authorUpdateStatus===1" dark @click="editPastor">Update</v-btn>
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
import {API} from "../../config";

export default {
  props:["slug"],
    data: () => ({
      title:"",
      biography:"",
      ica_pastor:true,
      name:"",
      suffix:"",
      avatar:"",
      filename:"",

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
      this.$store.dispatch('AuthorShow',{
        slug:this.slug
      })
    },
    mounted(){


    },
    computed: {
      author(){
        return this.$store.getters.getAuthor
      },
      authorLoadStatus(){
        return this.$store.getters.getAuthorLoadStatus
      },
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
      authorUpdateStatus(){
        return this.$store.getters.getAuthorsUpdateStatus
      }

    },
    watch: {
      authorLoadStatus:function () {
        switch (this.authorLoadStatus) {
          case 1:
            break;
          case 2:
            this.name=this.author.name
            this.suffix=this.author.suffix
            this.title=this.author.title
            this.ica_pastor=this.author.ica_pastor==1?true:false
            this.biography=this.author.biography
            this.filename=this.computeImageUrl(this.author.avatar)
            break;
          case 3:
            break;
          case 4:
            break;
          default:
            break;
        }
        },
      authorUpdateStatus:function () {
        switch (this.authorUpdateStatus) {
          case 1:
            this.snackbarMessage="Updating pastor";
            break;
          case 2:
            this.snackbarMessage="Updated successfully.";
            this.$router.push('/pastors');
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
      editPastor(){
        if(!this.validation)
          this.snackbar=true
        else{
          this.$store.dispatch("AuthorsUpdate",{
            slug:this.slug,
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
      },
      computeImageUrl(url){
        return API.URL+url
      },
    }
}
</script>
