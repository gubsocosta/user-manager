import axios from 'axios';
import { createStore } from 'vuex';
import type IUser from './interfaces/IUser';

export default createStore({
  state() {
    return {
      users: [] as IUser[],
    };
  },
  mutations: {
    setUsers(state, users): void {
      state.users = users;
    },
  },
  actions: {
    fetchUsers(context): void {
      axios
        .get<IUser[]>('/api/users')
        .then((response) => {
          context.commit('setUsers', response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  getters: {
    getUsers: state => state.users,
    getUserByUid: (state) => (uid: string): IUser | undefined => {
      return state.users.find(user => user.uid === uid);
    },
  }
});
