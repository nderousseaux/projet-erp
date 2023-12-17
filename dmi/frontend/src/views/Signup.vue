
<template>
  <div id="signup-view">
    <SignupForm/>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import SignupForm from '@/components/SignupForm';

export default {
  name: 'SignupView',
  components: {
    SignupForm
  },
  computed: {
    ...mapGetters({
      token: 'getToken',
    }),
  },
  created() {
    if (this.token) {
      this.$router.push('/home');
    }
  }
}
</script>

<style scoped>
  #signup-view {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  #signup-view > * {
    width: 100%;
    max-width: 400px;
    margin-top: 40px;
  }
</style>