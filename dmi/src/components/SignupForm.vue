<template>
  <n-card
		id="signup-form"
		title="Inscription"
	>
		<n-form>
			<n-form-item label="Identifiant">
				<n-input
					style="text-align: left;"
					:status="error ? 'error' : 'default'"
					placeholder="11111111"
					v-model:value="id"
				/>
			</n-form-item>
			<n-form-item label="Nom">
				<n-input
					style="text-align: left;"
					:status="error ? 'error' : 'default'"
					placeholder="Jean"
					v-model:value="firstname"
				/>
			</n-form-item>
			<n-form-item label="Prénom">
				<n-input
					style="text-align: left;"
					:status="error ? 'error' : 'default'"
					placeholder="Dupont"
					v-model:value="name"
				/>
			</n-form-item>
			<n-form-item label="Mot de passe">
				<n-input 
					type="password"
					style="text-align: left;"
					:status="error ? 'error' : 'default'"
					placeholder="****************"
					v-model:value="password"
				/>
			</n-form-item>
			<n-form-item label="Confirmation du mot de passe">
				<n-input 
					type="password"
					style="text-align: left;"
					:status="error ? 'error' : 'default'"
					placeholder="****************"
					v-model:value="passwordVerif"
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
						Créer un compte
					</n-button>
					<n-button
						text
						tag="a"
						href="/login"
						type="primary"
					>
						Se connecter
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
	name: "SignupForm",
	components: {
		NCard,
		NForm,
		NFormItem,
		NInput,
		NButton,
	},
	data: () => ({
		id: '',
		name: '',
		firstname: '',
		password: '',
		passwordVerif: '',
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
		...mapActions(['signin']),

		async clickLogin() {
			await this.signin({
				id: this.id,
				name: this.name,
				firstname: this.firstname,
				password: this.password,
				passwordVerif: this.passwordVerif,
			});
			if (!this.error) {
				this.$router.push('/login');
			}
		},
	},
}
</script>