<style xmlns:v-if="http://www.w3.org/1999/xhtml" lang="scss">
@import "../../sass/variables";

.custom-font{
    font-family: "Raleway", sans-serif;
}

.semi-bold{
    font-weight: 600;
}

.bold{
    font-weight: 700;
}
h1.header-title {
    font-weight: 700;
    font-size: 26pt;
    line-height: normal;
}

#main{
    padding-bottom: 88px;
}

.header{
    background-position:center;
    background-repeat:none;
    background-size: cover;
    width: 100%;
    height:350px;
    background-color: $app-color;
    color: white;
}
.header-content {
    width: 100%;
    text-align: center;
    font-family: 'Raleway', sans-serif;
    //background-color: black;



    p.header-caption {
        margin-bottom: 16px;
    }

    p.header-subtitle {
        font-size: 14pt;
        font-weight: 600;
    }
    .header-avatar{
        margin-top: 16px;
    }

    div.header-avatar-img{
        height: 30px;
        width: 30px;
        border-radius: 50%;
        background-color: #ffffff;
        background-position:center;
        background-repeat:none;
        background-size: cover;
        background-image: url("http://localhost:8000/images/enson_lwesya.jpg");
    }

    div.header-avatar-name span{
        font-weight: 600;
        margin-left: 10px;
    }
}
//
//.content-card, .pastor-card{
//    &:hover{
//        cursor: pointer;
//    }
//}

.more-details{
  position: absolute;
  right: 0;
}

.v-application ul.more-details-dropdown{
  list-style:none;
  padding: 0 12px;
  display: inline-flex;
}

.v-list, .v-dialog{
  font-family: 'Raleway', sans-serif;

}

.v-pagination{
  padding: 54px 0 0;
}

.content{
    padding: 30px 16px;
    font-family: 'Raleway', sans-serif;
    color: $app-color;

    .v-divider{
      margin-bottom: 12px;
    }

    .col-12{
        padding:0 12px 12px 12px;
    }

  .content-card{
    position: relative;

    .content-wrapper{
      padding:0 24px 0 0;
    }

  }





    p.content-heading{
        font-size: 13pt;
        //padding-bottom: 16px;
    }

    p.content-caption{
        font-size: 10pt;
        margin:0;
    }

    p.content-title{
        font-size: 13pt;
        font-weight: 700;
        margin:0;
    }

    p.content-subtitle{
        font-weight: 600;
        font-size: 11pt;
        margin:0;
    }

    div.content-avatar{
        padding:8px 0 0 0;
    }

    div.content-avatar-img{
        height: 25px;
        width: 25px;
        border-radius: 50%;
        background-color: $background;
        background-position:center;
        background-repeat:none;
        background-size: cover;
        //background-image: url("http://localhost:8000/images/enson_lwesya.jpg");
    }

    div.content-avatar-name span{
        font-size: 10pt;
        //font-weight: 600;
        margin-left: 10px;
    }

    div.content-button{
        width: 150px;
        margin:44px auto 12px auto;

        button{
            text-align: center;
            padding: 7px;
            border: thin solid rgba(0,0,0,.12);
            width: 100%;
            font-size: 10pt;
            transition: all 700ms;
        }

        &:hover{
            box-shadow: 0 0 8px 0 #e7e7e7;
            background-color: #fafafa;
        }
    }

    //For series object
    .sermon-count{
        font-size: 11pt;
        font-weight: 700;
        margin: 16px 0 0 0;
    }

    .content-description{
        font-size: 11pt;
        margin: 0;
    }

    div.content-spacer{
        width: 100%;
        height: 42px;
    }

    .compound-view-container{
        margin-top: 24px;
    }
    .compound-view-container:first-of-type{
        margin-top: 0;
    }
}

a:hover{
      text-decoration: none;
    }

@media (min-width: 600px) {
    h1.header-title {
        font-size: 30pt;
    }

    .header{
        height:380px;

    }
    .header-content {



        p.header-caption {
            font-size: 14pt;
            margin-bottom: 16px;
        }

        p.header-subtitle {
            font-size: 16pt;
        }

        div.header-avatar-img{
            height: 32px;
            width: 32px;
        }

        div.header-avatar-name span{
            margin-left: 12px;
            font-size: 14pt;
        }
    }

    //.content{
    //    padding: 36px 24px;
    //
    //    .v-divider{
    //        display: none;
    //    }
    //
    //    .col-sm-6{
    //        padding:0 12px 16px 12px;
    //    }
    //
    //    .content-card{
    //        border: thin solid rgba(0,0,0,.12);
    //        border-radius: 5px;
    //        padding:24px 16px 60px 16px;
    //        height: 100%;
    //        position: relative;
    //    }
    //
    //
    //    p.content-heading{
    //        font-size: 14pt;
    //        padding-bottom: 16px;
    //    }
    //
    //    p.content-caption{
    //        font-size: 11pt;
    //        margin:0;
    //    }
    //
    //    p.content-title{
    //        font-size: 14pt;
    //        margin:0;
    //    }
    //
    //    p.content-subtitle{
    //        margin:0;
    //    }
    //
    //    div.content-avatar, p.sermon-count{
    //        padding-bottom:16px;
    //        position: absolute;
    //        bottom: 0;
    //    }
    //
    //    div.content-avatar-img{
    //        height: 27px;
    //        width: 27px;
    //    }
    //
    //    div.content-avatar-name span{
    //        font-size: 11pt;
    //        margin-left: 12px;
    //    }
    //
    //    div.content-button{
    //        width: 160px;
    //        margin:44px auto 12px auto;
    //
    //        button{
    //            padding: 8px;
    //            font-size: 11pt;
    //        }
    //    }
    //
    //    .content-description{
    //        font-size: 11pt;
    //        margin: 0;
    //    }
    //}
    //
    //.content-card, .pastor-card{
    //    &:hover{
    //        box-shadow: 0 0 8px 0 #e7e7e7;
    //    }
    //}

}
@media (min-width: 768px) {
    h1.header-title {
        font-size: 34pt;
    }

    .header{
        height:400px;
    }
    .header-content {

        p.header-caption {
            font-size: 15pt;
            margin-bottom: 16px;
        }

        p.header-subtitle {
            font-size: 17pt;
        }

        div.header-avatar-img{
            height: 34px;
            width: 34px;
        }

        div.header-avatar-name span{
            //margin-left: 10px;
            font-size: 15pt;
        }
    }

    //.content{
    //    padding: 42px 30px;
    //
    //    .v-divider{
    //        display: none;
    //    }
    //
    //    .col-sm-6{
    //        padding:0 12px 16px 12px;
    //    }
    //
    //    .content-card{
    //        padding:30px 24px 66px 24px;
    //    }
    //
    //
    //    p.content-heading{
    //        font-size: 14pt;
    //        padding-bottom: 24px;
    //    }
    //
    //    p.content-caption{
    //        font-size: 11pt;
    //        margin:0 0 5px 0;
    //    }
    //
    //    p.content-title{
    //        font-size: 14pt;
    //        margin:0;
    //    }
    //
    //    p.content-subtitle{
    //        margin:0;
    //    }
    //
    //    div.content-avatar, p.sermon-count{
    //        padding-bottom:24px;
    //        position: absolute;
    //        bottom: 0;
    //    }
    //
    //    div.content-avatar-img{
    //        height: 25px;
    //        width: 25px;
    //    }
    //
    //    div.content-avatar-name span{
    //        font-size: 11pt;
    //        margin-left: 12px;
    //    }
    //
    //    div.content-button{
    //        //width: 150px;
    //        margin:50px auto 12px auto;
    //
    //        button{
    //            //padding: 7px;
    //            //font-size: 10pt;
    //        }
    //    }
    //
    //    .content-description{
    //        font-size: 11pt;
    //        margin: 0;
    //    }
    //}

}
@media (min-width: 960px) {

    h1.header-title {
        font-size: 36pt;
    }

    .header{
        height:420px;
    }

    .header-content {

        p.header-caption {
            font-size: 16pt;
            margin-bottom: 16px;
        }

        p.header-subtitle {
            font-size: 18pt;
        }

        div.header-avatar-img{
            height: 36px;
            width: 36px;
        }

        div.header-avatar-name span{
            //margin-left: 10px;
            font-size: 16pt;
        }
    }

    //.content{
    //    padding: 52px 30px;
    //
    //    .v-divider{
    //        display: none;
    //    }
    //
    //    .col-sm-6{
    //        padding:0 12px 24px 12px;
    //    }
    //
    //    .content-card{
    //
    //    }
    //
    //
    //    p.content-heading{
    //        font-size: 15pt;
    //        //padding-bottom: 24px;
    //    }
    //
    //    p.content-caption{
    //        font-size: 11pt;
    //        margin:0 0 5px 0;
    //    }
    //
    //    p.content-title{
    //        font-size: 15pt;
    //        margin:0;
    //    }
    //
    //    p.content-subtitle{
    //        font-size: 13pt;
    //        margin:0;
    //    }
    //
    //    div.content-avatar-img{
    //        height: 25px;
    //        width: 25px;
    //    }
    //
    //    div.content-avatar-name span{
    //        font-size: 11pt;
    //        margin-left: 12px;
    //    }
    //
    //    div.content-button{
    //        //width: 150px;
    //        margin:56px auto 12px auto;
    //
    //        button{
    //            //padding: 7px;
    //            //font-size: 10pt;
    //        }
    //    }
    //
    //    .content-description, .sermon-count{
    //        font-size: 12pt;
    //    }
    //}
}
@media (min-width: 1200px) {
    h1.header-title {
        font-size: 38pt;
    }

    .header{
        height:480px;
    }

    .header-content {

        p.header-caption {
            font-size: 18pt;
            //   margin-bottom: 16px;
        }

        p.header-subtitle {
            font-size: 20pt;
        }

        div.header-avatar-img{
            height: 38px;
            width: 38px;
        }

        div.header-avatar-name span{
            //margin-left: 10px;
            font-size: 18pt;
        }
    }

    //.content{
    //    padding: 64px 30px;
    //
    //    .v-divider{
    //        display: none;
    //    }
    //
    //    .col-sm-6{
    //        padding:0 12px 16px 12px;
    //    }
    //
    //    .content-card{
    //
    //    }
    //
    //
    //    p.content-heading{
    //        //font-size: 14pt;
    //        padding-bottom: 16px;
    //    }
    //
    //    p.content-caption{
    //        //font-size: 11pt;
    //        margin:0 0 5px 0;
    //    }
    //
    //    p.content-title{
    //        //font-size: 14pt;
    //        margin:0;
    //    }
    //
    //    p.content-subtitle{
    //        margin:0;
    //    }
    //
    //    div.content-avatar, p.sermon-count{
    //
    //    }
    //
    //    div.content-avatar-img{
    //        height: 25px;
    //        width: 25px;
    //    }
    //
    //    div.content-avatar-name span{
    //        //font-size: 11pt;
    //        margin-left: 12px;
    //    }
    //
    //    div.content-button{
    //        //width: 150px;
    //        //margin:44px auto 12px auto;
    //
    //        button{
    //            //padding: 7px;
    //            //font-size: 10pt;
    //        }
    //    }
    //
    //    .content-description{
    //        //font-size: 11pt;
    //        margin: 0;
    //    }
    //}
}

</style>

<template>
    <v-app>
        <navbar ref="navbar"></navbar>
        <app-header @toggle-drawer="$refs.navbar.drawer = !$refs.navbar.drawer"></app-header>
        <v-main>
            <div id="main">
                <router-view></router-view>
                <app-footer></app-footer>
            </div>
        </v-main>

    </v-app>
</template>

<script>
import Navbar from "../components/global/Navbar";
import AppHeader from "../components/global/AppHeader";
import AppFooter from "../components/global/AppFooter";

export default {
    data: () => ({

    }),
    components:{
        Navbar,
        AppHeader,
        AppFooter
    },
    created(){
        // this.$store.dispatch('SermonsIndex')
        // this.$store.dispatch('AuthorsIndex')

    },
    mounted(){

    },
    computed: {

    },
    watch: {


    },
    methods:{

    },
};
</script>
