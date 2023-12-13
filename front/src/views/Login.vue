
<template>
  <div id="login-view">
    <LoginForm/>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import LoginForm from '@/components/LoginForm';

export default {
  name: 'LoginView',
  components: {
    LoginForm
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
  #login-view {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  #login-view > * {
    width: 100%;
    max-width: 400px;
    margin-top: 40px;
  }
</style>