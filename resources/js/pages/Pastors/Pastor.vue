<style scoped lang="scss">
@import "../../../sass/variables";

#pastor{
    padding: 0 16px;

    .v-divider{
        display: none;
    }

    .pastor-image{
        margin: 0 auto 24px auto;
        height: 200px;
        width: 200px;
        border-radius: 50%;
        background-color: #fafafa;
        background-position: center;
        background-repeat: none;
        background-size: cover;
    }

    .header-caption{
        margin: 0;
    }
}

.header-content{
    padding: 60px 0 0 0;

    .header-description{
        margin-top: 24px;
        padding: 16px;
        text-align: left;
        background-color: #fafafa;

        span{
            font-size: 10pt;
            font-weight: 700;
        }

        p{
            margin: 0;
        }
    }
}



@media (min-width: 600px) {
    .header-content{
        padding: 65px 0 0;
    }

    #pastor{
        padding: 0 30px;

        .v-divider{
            display: block;
        }

        .pastor-image{
            height: 230px;
            width: 230px;
        }
    }

}
@media (min-width: 768px) {
    .header-content{
        padding: 70px 0 0 0;
    }

    #pastor{
        .pastor-image{
            height: 250px;
            width: 250px;
        }
    }


}
@media (min-width: 960px) {
    .header-content{

        .header-description{
            padding: 24px;

            span{
                font-size: 11pt;
            }

            p{
                font-size: 13pt;
            }
        }
    }

    #pastor{
        .pastor-image{
            height: 270px;
            width: 270px;
        }
    }
}
@media (min-width: 1200px) {
    #pastor{
        .pastor-image{
            height: 290px;
            width: 290px;
        }
    }
}


</style>

<template>
    <div>
      <div v-if="authorLoadStatus===1">
        <div class="content-spacer"></div>
        <div class="d-flex justify-center">
          <v-progress-circular indeterminate></v-progress-circular>
        </div>
      </div>
      <div  v-else-if="authorLoadStatus===2 && !author.isEmpty">
        <v-layout
            id="pastor"
        >
          <v-container class="">
            <div class="header-content ">
              <div class="pastor-image"
                   :style="{
                      backgroundImage:`url(${computeImageUrl(author.avatar)})`
                   }"
              ></div>
              <p class="header-caption">{{author.title}}</p>
              <h1 class="header-title">{{ author.name }}</h1>
              <div class="header-description">
                <span>BIOGRAPHY</span>
                <div>{{author.biography}}</div>
              </div>
            </div>
<!--            <v-divider></v-divider>-->
          </v-container>
        </v-layout>
        <v-layout class="content">
          <v-container>
            <div v-if="authorSermonsStatus===1">
              <div class="content-spacer"></div>
              <div class="d-flex justify-center">
                <v-progress-circular indeterminate></v-progress-circular>
              </div>
            </div>
            <!--                <p class="content-heading">{{ computeSermonsCount(author.sermon_count) }} </p>-->
            <div
                class="compound-view-container"
                v-for="(sermonCompound,index) in authorSermons"
                :index="index"
                v-else-if="authorSermonsStatus===2"
            >
              <p class="content-heading">{{ sermonCompound.month + " " + sermonCompound.year }}</p>
              <v-row>
                <sermon
                    v-for="sermon in sermonCompound.sermons"
                    :key="sermon.id"
                    :sermon="sermon"
                    :delete-status="sermonsDeleteStatus"
                    :restore-status="sermonsRestoreStatus"
                ></sermon>
              </v-row>
            </div>
            <v-pagination
                v-model="page"
                :length="lastPage"
                v-show="lastPage!==0 && authorSermons.length!==0"
            ></v-pagination>
<!--            <div v-if="authorSermonsAppendStatus!==1" v-show="moreSermons" class="content-button">-->
<!--              <button :disabled="authorSermonsAppendStatus===1" @click="loadMore">Load More</button>-->
<!--            </div>-->

          </v-container>
        </v-layout>
      </div>
      <div class="message" v-else-if="authorLoadStatus===3">
        <p>An error occurred</p>
      </div>
      <div class="message" v-else>
        <p>Author not found</p>
      </div>
    </div>
</template>

<script>
import {API} from "../../config";
import Sermon from "../../components/Sermon";

export default {
    props:['slug'],
    data: () => ({
      page:1,
      snackbar:false,
      snackbarMessage:"",
      deleteDialog:false
    }),
    components:{
      Sermon
    },
    created(){
      window.scrollTo(0,0)
      this.$store.dispatch('AuthorShow',{
        slug:this.slug
      })
      this.$store.dispatch('AuthorSermons',{
        slug:this.slug,
        page:1
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
      authorSermons(){
        let unsorted=this.$store.getters.getAuthorSermons
        let sorted=[]
        let index=0

        if (unsorted){
          if (unsorted.length!==0) {
            let currentMonth = unsorted[0].published_date.month
            let currentYear = unsorted[0].published_date.year

            for (let item in unsorted) {
              if (item === '0') {
                sorted.push({
                  month: currentMonth,
                  year: currentYear,
                  sermons: [unsorted[item]]
                })
              } else {
                if (currentMonth === unsorted[item].published_date.month && currentYear === unsorted[item].published_date.year) {
                  sorted[index].sermons.push(unsorted[item])
                } else {
                  index++
                  currentMonth = unsorted[item].published_date.month
                  currentYear = unsorted[item].published_date.year

                  sorted.push({
                    month: currentMonth,
                    year: currentYear,
                    sermons: [unsorted[item]]
                  })
                }
              }
            }
          }
          return sorted
        }else
          return []
      },
      authorSermonsStatus(){
        return this.$store.getters.getAuthorSermonsLoadStatus
      },
      moreSermons(){
        return this.$store.getters.getMoreAuthorSermons
      },
      sermonsDeleteStatus(){
        return this.$store.getters.getSermonsDeleteStatus
      },
      sermonsRestoreStatus(){
        return this.$store.getters.getSermonsRestoreStatus
      },
      lastPage(){
        return this.$store.getters.getAuthorSermonsLastPage
      }
    },
    watch: {
      page:function () {
        this.$store.dispatch('AuthorSermons',{
          slug:this.slug,
          page:this.page
        })
      },
      sermonsDeleteStatus:function () {
        switch (this.sermonsDeleteStatus) {
          case 1:
            this.snackbarMessage="Deleting sermon";
            break;
          case 2:
            this.snackbarMessage="Deleted successfully.";
            this.$router.go();
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
    },
    methods:{
      loadMore(){
        this.$store.dispatch('AuthorAppendSermons')
      },
      computeImageUrl(url){
        return API.URL+url
      },
      routeToSermon(slug){
        this.$router.push({name:"sermon", params:{slug:slug}})
      },
      computeDate:function (date) {
        return date.month + " " + date.day + ", " + date.year
      },
      computeSermonsCount(count){
        switch (count){
          case 1:
            return count + " Sermon"
          default:
            return count + " Sermons"
        }
      },
    }


}
</script>
