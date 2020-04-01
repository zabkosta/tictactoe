<template>
  <v-row  :justify="'center'" class="align-center">
    <div style="position: relative">
      <v-progress-circular
        v-if="loading"
        :size="boxSize"
        :width="boxSize/10"
        :style="{top: (boxSize*gameSize/2 - boxSize/2) + 'px', left:  (boxSize*gameSize/2 - boxSize/2) + 'px'}"
        color="green"
        indeterminate
      ></v-progress-circular>

      <div class="board" :style="{width: boxSize*gameSize + 'px'}">

        <div v-for="r in gameSize"
             :key="r"
             class="board-row">
            <div v-for="n in gameSize"
                 :key="n-1 + (r-1)*gameSize"
                 :data-cell="n-1 + (r-1)*gameSize"
                 @click="setMark(n-1 + (r-1)*gameSize)"
                 class="board-cell"
                 :style="{width: boxSize + 'px', height: boxSize + 'px',  'line-height': boxSize + 'px', 'font-size':  boxSize + 'px'}"
                >
              {{ gameBoard[n-1 + (r-1)*gameSize] }}
            </div>
        </div>

      </div>
    </div>
  </v-row>
</template>

<script>

  import {mapState} from 'vuex'

  export default {
    name: "Board",
    data: function(){
      return {
          loading: false
       }
    },
    computed: {
      ...mapState({

        gameSize: state => state.game.gameSize,
        userPlayer: state => state.game.userPlayer,
        gameBoard: state => state.game.gameBoard,
        boxSize: state => state.boxSize
      }),

    },



    methods: {
      setMark: function (index) {
        this.$store.commit('setMark', index);
        this.$forceUpdate();
        // activate preloader
        this.loading = true;

        this.$store.dispatch('fetchNextMove');

      }
    }




  }
</script>

<style>

  .board-cell {
    background: #f90;
    color: #fff;
    font-family: 'Helvetica', 'Arial', sans-serif;
    font-weight: bold;
    text-align: center;
    border-radius: 0;
    border-color: black;
    border-width: 1px;
    border-style: solid;
    display:table-cell;
  }
  .boarde-row {
    display: table-row;
  }

  .board{
    display: table;
    table-layout: fixed; /*Optional*/
  }
  .v-progress-circular {
    z-index: 100;
    position: absolute;
    top: 160px;
    left:160px;

  }

</style>
