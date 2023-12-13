<template>
  <n-card
		id="signup-form"
		title="Inscription"
	>
		<n-form>
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
			<n-form-item label="Adresse">
				<n-input
					style="text-align: left;"
					:status="error ? 'error' : 'default'"
					placeholder="15 rue de la Paix 67000 Strasbourg"
					v-model:value="address"
				/>
			</n-form-item>
			<n-form-item label="Date de naissance">
				<n-date-picker
					style="text-align: left;"
					:status="error ? 'error' : 'default'"
					placeholder="01/01/1970"
					v-model:value="timestamp" type="date"
				/>
			</n-form-item>
			<n-form-item label="Lieu de naissance">
				<n-input
					style="text-align: left;"
					:status="error ? 'error' : 'default'"
					placeholder="Strasbourg"
					v-model:value="placeBirth"
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
	NDatePicker,
} from 'naive-ui'

export default {
	name: "SignupForm",
	components: {
		NCard,
		NForm,
		NFormItem,
		NInput,
		NButton,
		NDatePicker,
	},
	data: () => ({
		name: '',
		firstname: '',
		address: '',
		timestamp: null,
		placeBirth: '',
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
				name: this.name,
				firstname: this.firstname,
				address: this.address,
				timestamp: this.timestamp,
				placeBirth: this.placeBirth,
				password: this.password,
				passwordVerif: this.passwordVerif,
			});
			console.log(this.error)
			if (!this.error) {
				this.$router.push('/login');
			}
		},
	},
}
</script>