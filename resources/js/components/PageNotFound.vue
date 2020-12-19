<template>
  <div id="NotFoundComponent" class="pageNotFound">

    <v-card
      width="600"
    >
      <v-img :src="'/img/bg/pagenotfound.jpg'"></v-img>
    <v-card-actions>
      <v-btn
        color="#ee6e52"
        block
        @click="goBack"
      >
        <v-icon left style="color: #fff">mdi-arrow-left-bold</v-icon><span style="color: #fff">Go Back</span>
      </v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
export default {
  methods: {
    goBack(){
      this.$router.push({name : 'Home'})
    }
  }
}
</script>

<style>

</style>