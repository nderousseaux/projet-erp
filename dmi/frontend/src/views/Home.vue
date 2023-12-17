
<template>
  <div id="home-view">
    <PageHeader/>
    <n-layout style="max-width: 1200px">
      <n-layout-content content-style="padding: 24px;">
        <MedsPrev/>
      </n-layout-content>
      <n-layout-content content-style="padding: 24px;">
        <MedsPass/>
      </n-layout-content>
    </n-layout>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

import { NLayout, NLayoutContent } from 'naive-ui'

import PageHeader from '@/components/PageHeader'
import MedsPrev from '@/components/MedsPrev'
import MedsPass from '@/components/MedsPass'

export default {
  name: 'HomeView',
  components: {
    PageHeader,
    MedsPrev,
    MedsPass,
    NLayout,
    NLayoutContent,
  },

  computed: {
    ...mapGetters({
      token: 'getToken',
    })
  },

  created() {
    if (!this.token) {
      this.$router.push('/login');
    }
  },
}
</script>

<style scoped>
  #home-view {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  #home-view > * {
    width: 100%;
  }
</style>