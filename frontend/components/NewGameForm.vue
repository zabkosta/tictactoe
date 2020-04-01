<template>
  <v-row  :justify="'center'" class="align-center">
    <v-form
      ref="form"
      v-model="valid"
    >

      <v-radio-group
        :valuel="userPlayer"
        @change="updateField($event)"
        label="Choose your player"
        :mandatory="true"
        column
       >
        <v-radio
          label="Play as 'X'"
          value="X"
        ></v-radio>
        <v-spacer/>
        <v-radio
          label="Play as 'O'"
          value="O"
        ></v-radio>
      </v-radio-group>

      <v-select
        :value="userDimension"
        :items="items"
        :rules="[v => !!v || 'Item is required']"
        item-text="label"
        item-value="val"
        label="Choose field size"
        hint="Choose matrix size"
        class="mt-6"
        @change="updateGameSize($event)"
        required
      ></v-select>


      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4 mt-6"
        @click="start"
        block
      >
        Start game
      </v-btn>


    </v-form>
  </v-row>

</template>

<script>

    import {mapState} from 'vuex'

    export default {
      name: "newgame",

      data: () => ({
        valid: false,
      }),

      computed: {
        ...mapState({

          userDimension: state => state.game.gameSize,
          userPlayer: state => state.game.userPlayer,
          items: state => state.boardSizes
        }),

      },

      methods: {
        start: function () {
          this.$store.commit('setGameID');
        },
        // update Vuex State
        updateGameSize(target){
          this.$store.commit('setSize',target);
        },
        updateField(value){
          //debugger;
          this.$store.commit('setPlayer',value);
        }

      },



    }

</script>
