<template>
  <div class="box">
    <article class="media">
      <div class="media-left">
        <figure class="image is-64x64">
          <img :src="user.avatar" alt="Image" />
        </figure>
      </div>
      <div class="media-content">
        <div class="content">
          <p>
            <strong>{{ `${user.first_name} ${user.last_name}` }}</strong>
          </p>
          <p>
            <small>@{{ user.username }}</small>
          </p>
        </div>
        <nav class="level is-mobile">
          <div class="level-left">
            <button
              class="button is-small is-info is-light"
              aria-label="reply"
              @click="clicked"
            >
              <span class="icon is-small">
                <i class="fas fa-search" aria-hidden="true"></i>
              </span>
            </button>
          </div>
        </nav>
      </div>
    </article>
  </div>
</template>

<script lang="ts">
import type IUser from '@/interfaces/IUser';
import { defineComponent, type PropType } from 'vue';

export default defineComponent({
  name: 'Box',
  props: {
    user: {
      type: Object as PropType<IUser>,
      required: true,
    },
  },
  emits: ['clicked'],
  methods: {
    clicked(): void {
      this.$emit('clicked', this.user.uid);
    },
  },
});
</script>
