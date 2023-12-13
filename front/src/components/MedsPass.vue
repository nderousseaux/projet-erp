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
import { h } from 'vue'
import { mapGetters, mapActions} from 'vuex';

import { NDataTable, NH2, NText, NSpin, NButton} from 'naive-ui'


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
				{
					title: 'Résultat',
					key: 'results',
					render (row) {
						return h(
							NButton,
							{
								size: 'small',
								onClick: () => {
									window.open(row.results);
								}
							},
							{ default: () => 'Ouvrir le pdf' }
						)
					}
				}
			],
		}
	},

	mounted() {
		this.getMeds();
	},

	computed: {
		...mapGetters({
			medsData: 'getMedsPass',
			loading: 'getLoading',
		}),

		meds() {
			// € devant les nombres
			const formatter = new Intl.NumberFormat('fr-FR', {
				style: 'currency',
				currency: 'EUR',
			});

			return this.medsData.map((med) => {
				return {
					date: med.date,
					time: med.time,
					place: med.place,
					intervention: med.intervention,
					notes: med.notes,
					fees: formatter.format(med.fees),
					remboursement: formatter.format(med.remboursement),
					topay: formatter.format(med.topay),
					confirm: med.confirm ? 'Oui' : 'Non',
					results: med.results,
				}
			})
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