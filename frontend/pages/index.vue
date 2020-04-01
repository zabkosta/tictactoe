<template>
  <v-layout
    column
    justify-center
    align-center
  >
    <v-flex
      xs12
      sm8
      md6
    >
        <newgame v-if="gameID === null"/>

        <Board v-if="gameID"/>

    </v-flex>
  </v-layout>
</template>

<script>

  import {mapState} from 'vuex'
  import Board from '~/components/Board';
  import newgame from '~/components/NewGameForm';

export default {
  components: {
    Board,
    newgame
  },
  computed: {
    ...mapState({
      gameID: state => state.game.gameID,
    }),

  },

}
</script>
