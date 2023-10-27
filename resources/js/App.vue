<template>
  <main class="columns is-gapless is-multiline">
    <div class="column is-5 list">
      <SideBar>
        <Box v-for="(user, index) in users" :key="index" :user="user"></Box>
      </SideBar>
    </div>
    <div class="column">
      <Detail :user="userDetails"></Detail>
    </div>
  </main>
</template>

<script lang="ts">
import Box from '@/components/Box.vue';
import Detail from '@/components/Detail.vue';
import SideBar from '@/components/SideBar.vue';
import { defineComponent } from 'vue';
import { mapActions, mapGetters, mapState } from 'vuex';
import type IUser from './interfaces/IUser';

export default defineComponent({
  name: 'App',
  components: {
    Box,
    SideBar,
    Detail,
  },
  data() {
    return {
      userUid: '',
    };
  },
  computed: {
    ...mapState(['users']),
    ...mapGetters(['getUserByUid']),
    userDetails(): IUser | undefined {
      return this.getUserByUid(this.userUid);
    },
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    ...mapActions(['fetchUsers']),
  },
});
</script>
<style scoped>
.list {
  padding: 1rem;
}
</style>
