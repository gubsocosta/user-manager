<template>
  <div v-if="!isUserUndefined" class="card">
    <div class="card-content">
      <div class="media">
        <div class="media-left">
          <figure class="image is-48x48">
            <img :src="user?.avatar" alt="Placeholder image" />
          </figure>
        </div>
        <div class="media-content">
          <p class="title is-4">{{ `${user?.first_name} ${user?.last_name}` }}</p>
          <p class="subtitle is-6">@{{ user?.username }}</p>
        </div>
      </div>
      <section class="section">
        <h1 class="title">User info</h1>
        <p>first_name</p>
        <p>last_name</p>
        <p>username</p>
        <p>email</p>
        <p>avatar</p>
        <p>gender</p>
        <p>phone_number</p>
        <p>social_insurance_number</p>
        <p>date_of_birth</p>
      </section>
      <section class="section">
        <h1 class="title">Employment</h1>
        <p>title</p>
        <p>key_skill</p>
      </section>
      <section class="section">
        <h1 class="title">Address</h1>
        <p>city</p>
        <p>street_name</p>
        <p>street_address</p>
        <p>zip_code</p>
        <p>state</p>
        <p>country</p>
        <p>coordinates</p>
      </section>
      <section class="section">
        <h1 class="title">Payment</h1>
        <p>cc_number</p>
      </section>
      <section class="section">
        <h1 class="title">Subscription</h1>
        <p>plan</p>
        <p>status</p>
        <p>payment_method</p>
        <p>term</p>
      </section>
    </div>
  </div>
</template>

<script lang="ts">
import type IUser from '@/interfaces/IUser';
import { defineComponent, type PropType } from 'vue';
export default defineComponent({
  name: 'Detail',
  props: {
    user: {
      type: Object as PropType<IUser> | undefined,
    },
  },
  computed: {
    isUserUndefined(): boolean {
      return this.user === undefined;
    },
  },
});
</script>
