<template>
  <n-page-header 
		id="page-header"
		subtitle="Vos actes médicaux"
	>
    <template #title>
			DMI
    </template>
    <template #avatar>
      <n-avatar
				src="logo.png"
				size="large"
      />
    </template>
    <template #extra>
      <n-space>
        <n-button
					@click="handleBack"
				>Déconnexion</n-button>
      </n-space>
    </template>
  </n-page-header>
</template>

<script>
import { mapActions } from 'vuex';

import {
	NPageHeader,
	NAvatar,
	NSpace,
	NButton, 
} from 'naive-ui'

export default {
	name: "PageHeader",
	components: {
		NPageHeader,
		NAvatar,
		NSpace,
		NButton,
	},

	methods: {
		...mapActions(['logout']),

		handleBack() {
			this.logout();
			this.$router.push('/login');
		},
	},
}
</script>