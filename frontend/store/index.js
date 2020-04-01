
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
      {label: '4X4', val: 4},
      {label: '5X4', val: 5},
      {label: '6X6', val: 6}
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
  },
  setMark(state, index){

    if (state.game.gameBoard[index] === undefined){
      state.game.gameBoard[index] = state.game.userPlayer;
    }
  }

}

export const getters = {

}

export const actions = {


  fetchNextMove({commit,state}){

     this.$axios.put('/game/move', {game:state.game})
      .then((res) => {

       // commit('setPosts', res.data.data.posts);

        console.log(res);

      }).catch(e => {
      console.log(e);
      throw e;
    });

  },

}
