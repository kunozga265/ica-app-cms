<style scoped lang="scss">
@import "../../sass/_variables.scss";

p.latest-sermon {
    //color: rgba(265,265,265,.8);
    font-size: 9pt;
    font-weight: 500;
    margin-bottom: 16px;
    position: absolute;
    left: 0;
    top: 0;
    background-color: rgba(0,0,0,0.3);
    padding: 10px 15px;
}

@media (min-width: 600px) {
    p.latest-sermon {
        //left: 12px;
        //top: 12px;
        font-size: 10pt;
        padding: 12px 17px;
    }

}
@media (min-width: 768px) {
    p.latest-sermon {
        //left: 0;
        //top: 0;
        font-size: 11pt;
        padding: 14px 19px;

    }
}
@media (min-width: 960px) {
    p.latest-sermon {
        font-size: 12pt;
        padding: 16px 21px;
    }
}
@media (min-width: 1200px) {
    p.latest-sermon {
        font-size: 13pt;
        padding: 18px 23px;
    }
}


</style>

<template>
    <div>
      <v-layout
          class="content"
      >
        <v-container>
          <h1 class="header-title">Dashboard</h1>
        </v-container>
      </v-layout>
    </div>
</template>

<script>

import {API} from "../config";

export default {
    data: () => ({

    }),
    components:{

    },
    created(){
        window.scrollTo(0,0)

    },
    mounted(){

    },
    computed: {
        sermons:function(){
            let sermons=this.$store.getters.getSermons
            let limit=6

            if (sermons){
                if(sermons.length>=1)
                    return sermons.slice(0,limit)
                else
                    return []
            }else
                return []
        },
        sermonsLoadStatus(){
            return this.$store.getters.getSermonsLoadStatus
        },
        series:function(){
            let unfiltered=this.$store.getters.getSeries
            let filtered=[]
            let index=0;
            let limit=3

            for (let item in unfiltered){
                if (unfiltered[item].sermon_count!==0 && index!==limit){
                    filtered.push(unfiltered[item])
                    index++
                }
            }

            return filtered

        },
        seriesLoadStatus(){
            return this.$store.getters.getSeriesLoadStatus
        },
    },
    watch: {


    },
    methods:{
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
        routeToSermons(){
            this.$router.push({name:"sermons"})
        },
        routeToSermon(slug){
            this.$router.push({name:"sermon", params:{slug:slug}})
        },
        routeToSeries(){
            this.$router.push({name:"series"})
        },
        routeToSeriesView(slug){
            this.$router.push({name:"series-view", params:{slug:slug}})
        },
        computeImageUrl(url){
            return API.URL+url
        },
    }
}

</script>
