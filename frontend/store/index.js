import Vue from 'vue'

export const state = () => {
  return {
    game:{
      gameID: null,
      gameState: null,
      gameBoard: [],
      gameSize: null,
      userPlayer: null,
    },
    boardSizes: [
      {label: '3X3', val: 3},
      ],
    // size of square, px
    boxSize: 160
}

}

export const mutations = {

  setSize (state, size) {
    state.game.gameSize = size;
    state.game.gameBoard = new Array(size*size);
  },
  setPlayer(state, player){
    state.game.userPlayer = player;
  },
  setGameID(state){
    state.game.gameID =  Math.floor(Math.random() * Math.floor(999999));
    state.game.gameState = 'R';
  },
  setGameState(state, gameState){
    state.game.gameState = gameState;
  },
  setMark(state, index){

    if (state.game.gameBoard[index] === undefined){
     // state.game.gameBoard[index] = state.game.userPlayer;
      Vue.set(state.game.gameBoard, index, state.game.userPlayer)
    }
  },
  setAImark(state, data){
    if (state.game.gameBoard[data['index']] === undefined){
     // state.game.gameBoard[data['index']] = data['player'];
      Vue.set(state.game.gameBoard, data['index'], data['player'])
    }
  },
  restartGame(state){

    state.game.gameID =  Math.floor(Math.random() * Math.floor(999999));
    state.game.gameState = 'R';
    state.game.gameBoard = new Array(state.game.gameSize*state.game.gameSize);

  }

}

export const getters = {


}

export const actions = {


  fetchNextMove({commit,state}){

     this.$axios.put('/game/move', {game:state.game})
      .then((res) => {

        commit('setGameState',res.data.gameState);
        commit('setAImark', {index:res.data.nextMove, player:res.data.aiPlayer});

        console.log(res);

      }).catch(e => {
      console.log(e);
      throw e;
    });

  },

}
