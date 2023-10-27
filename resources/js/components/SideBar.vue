<template>
  <header>
    <h1 class="title"> Users</h1>
    <slot></slot>
  </header>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'SideBar',
});
</script>

<style scoped>
header {
  padding: 1rem;
  background: #7fb3eb;
  width: 100%;
}
@media only screen and (max-width: 768px) {
  header {
    padding: 2.5rem;
    height: auto;
  }
}
</style>
