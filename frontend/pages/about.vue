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

      <div class="text-center">
      </div>
      <v-card>
        <v-card-title class="headline text-center">
          Welcome to the TicTacToe game
        </v-card-title>
        <v-card-text>
          <p>This app is using  kind of AI algorithm to calculate position. Try to win, dude!</p>
          <p>
            For more information on algorithm, check out the <a
            href="https://www.geeksforgeeks.org/minimax-algorithm-in-game-theory-set-1-introduction/"
            target="_blank"
          >
            documentation
          </a>.
          </p>

        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn
            color="primary"
            nuxt
            to="/"
          >
            Return
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>

    export default {
    name: "about"
  }
</script>
