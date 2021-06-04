<style scoped lang="scss">
footer{
    position: absolute;
    bottom:0;
    width:100%;
    font-family: 'Raleway', sans-serif;
    padding: 20px;
    text-align: center;
    margin: auto;
    font-size: 10pt;

    .links{
        margin-bottom: 5px;

        a{
            text-decoration: none;
            margin: 0 8px;
        }
    }
    .social{
        .v-icon{
            margin: 0 5px;

            &:hover{
                cursor: pointer;
            }
        }
    }
}
</style>

<template>
    <footer>
        <div class="links">
            <span><a href="#">DOWNLOAD APP  </a>   |   <a href="#">  ABOUT</a></span>
        </div>
        <div class="social">
            <span>
            <v-icon>mdi-facebook</v-icon>
            <v-icon>mdi-twitter</v-icon>
            <v-icon>mdi-instagram</v-icon>
        </span>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer"
}
</script>

