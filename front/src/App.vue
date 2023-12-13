<template>

  <router-view/>
</template>

<script>

export default {
  name: 'App',
}
</script>

<style>
@import '@/assets/styles/_reset.scss';
@import '@/assets/styles/_variables.scss';



#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
	text-align: center;
	color: var(--dark-color);
}

#app > * {
  margin: 10px 20px;  
}

</style>
