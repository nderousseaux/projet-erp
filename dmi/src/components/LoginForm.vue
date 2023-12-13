<template>
  <n-card
		id="login-form"
		title="Connexion"
	>
		<n-form>
			<n-form-item label="Nom d'utilisateur">
				<n-input
					style="text-align: left;"
					:loading="loading"
					:status="error ? 'error' : 'default'"
					placeholder="JeanDupont"
					v-model:value="username"
				/>
			</n-form-item>
			<n-form-item label="Mot de passe">
				<n-input 
					type="password"
					style="text-align: left;"
					:loading="loading"
					:status="error ? 'error' : 'default'"
					placeholder="****************"
					v-model:value="password"
				/>
			</n-form-item>
			<n-form-item>
				<div style="display: flex; justify-content: 
				space-between; width: 100%;">
					<n-button
						type="primary"
						:loading="loading"
						@click="clickLogin"
					>
						Connexion
					</n-button>
					<n-button
						text
						tag="a"
						href="/signup"
						type="primary"
					>
						Créer un compte
					</n-button>
				</div>
			</n-form-item>
		</n-form>
	</n-card>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

import {
	NCard,
	NForm,
	NFormItem,
	NInput,
	NButton,
} from 'naive-ui'

export default {
	name: "LoginForm",
	components: {
		NCard,
		NForm,
		NFormItem,
		NInput,
		NButton,
	},
	data: () => ({
		username: '',
		password: '',
	}),

	computed: {
		...mapGetters({
			loading: 'getLoadingLogin',
			errorMessage: 'getErrorLoginMessage',
			token: 'getToken',
		}),

		error() {
			return this.errorMessage !== '';
		},
	},

	methods: {
		...mapActions(['login']),

		async clickLogin() {
			await this.login({
				username: this.username,
				password: this.password,
			});
			if (this.token) {
				this.$router.push('/');
			}
		},
	},
}
</script>