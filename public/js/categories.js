
Vue.component('modal', {
	template: '#modal-template'
})

Vue.component('example-modal', {
	template: '#example-modal'
})

new Vue({

	el: '#vue-wrapper',

	data: {

		categories: [],

		e_name: '',

		e_id: '',

		showModal: false

	},

	mounted() {

		this.getValueItems();

	},

	methods: {		

		setVal(val_id, val_name) {
			this.e_id = val_id;
			this.e_name = val_name;
		},

		getValueItems: function getValueItems() {
			axios.get('/testing').then(response => this.categories = response.data);
		},

		editItem: function () {
			var i_val_1 = document.getElementById('e_id');
			var n_val_1 = document.getElementById('e_name');

			axios.post('/category/' + i_val_1.value, {name: n_val_1.value}).then(response => {
				this.getValueItems();
				this.showModal=false
			});
		}
	}

});