<template>
  <v-app id="inspire">


    <v-app-bar
      app
      color="indigo"
      dark
    >
      <v-app-bar-nav-icon @click.stop="$router.push({path: '/about'})" />
      <v-spacer />
      <v-toolbar-title >TicTacToe</v-toolbar-title>
      <v-spacer />
    </v-app-bar>

    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col class="text-center">


            <nuxt/>

          </v-col>
        </v-row>
      </v-container>
    </v-content>
    <v-footer
      color="indigo"
      app
    >
      <span class="white--text">&copy; Kostiantyn Zablotskyi, 2020</span>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    name: "default",
    props: {
      source: String,
    },
    data: () => ({

    }),
  }
</script>
