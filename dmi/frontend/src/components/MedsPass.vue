<template>
	<section
		id="meds-pass"
	>
		<n-h2 prefix="bar">
      <n-text
			type="primary">
        Actes Médicaux Passés 
      </n-text>
    </n-h2>
		<n-spin :show="loading">
			<n-data-table
				:columns="columns"
				:data="meds"
				:pagination="{ pageSize: 5 }"
				:bordered="false"
			/>
		</n-spin>
	</section>
</template>


<script>
// import { h } from 'vue'
import { mapGetters, mapActions} from 'vuex';

import { NDataTable, NH2, NText, NSpin } from 'naive-ui'


export default {
	name: "MedPrev",

	components: {
		NDataTable,
		NH2,
		NText,
		NSpin,
	},

	data() {
		return {
			columns: [
				{
					title: 'Date',
					key: 'date',
				},
				{
					title: 'Heure',
					key: 'time',
				},
				{
					title: 'Lieu',
					key: 'place',
				},
				{
					title: 'Intervention',
					key: 'intervention',
				},
				{
					title: 'Commentaire',
					key: 'notes',
				},
				{
					title: 'Montant',
					key: 'fees',
				},
				{
					title: 'Prise en charge',
					key: 'remboursement',
				},
				{
					title: 'Reste à payer',
					key: 'topay',
				},
				// {
				// 	title: 'Résultat',
				// 	key: 'results',
				// 	render (row) {
				// 		return h(
				// 			NButton,
				// 			{
				// 				size: 'small',
				// 				onClick: () => {
				// 					window.open(row.results);
				// 				}
				// 			},
				// 			{ default: () => 'Ouvrir le pdf' }
				// 		)
				// 	}
				// }
			],
		}
	},

	mounted() {
		this.getMeds(this.id)
	},

	computed: {
		...mapGetters({
			medsData: 'getMedsPass',
			loading: 'getLoading',
			id: 'getId',
		}),

		meds() {
	
			if (!this.medsData) {
				return [];
			}
			console.log(this.medsData);
			this.medsData.forEach((med) => {
				med.d = med.date.split(' ')[0];
				med.time = med.date.split(' ')[1];
				med.date = med.d;
				med.place = med.lieu;
				med.intervention = med.type;
				// On supprime les deux derniers caractères
				med.fees = med.prix.slice(0, -3) + '€';
				med.fees = med.fees.replace(',', '');
				med.topay = med.restant.slice(0, -3) + '€';
				med.remboursement = parseInt(med.fees) - parseInt(med.topay) + '€';
			});

			return this.medsData;
		},
	},

	methods: {
		...mapActions({
			getMeds: 'fetchMeds',
		}),
	},

}
</script>


<style scoped>
h2 {
	text-align: left;
}
</style>