<template>
  <v-layout>
    <v-row  :justify="'center'">


        <Board :dimension="4"/>

    </v-row>
  </v-layout>
</template>


<script>

  import Board from '~/components/Board';

  export default {
    components: {
      Board
    }
  }
</script>

