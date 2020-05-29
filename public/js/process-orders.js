
$.getScript('./js/helper/utilities.js', function() {

	 // ===================OBJECT ORIENTED FORM=========================

	new Vue({

		el: '#app',

		data: {

			form: new Form({

				item: '',

				price: '',

				dealer_id: '',

				qty: ''
			})

		},

		methods: {

			onSubmit(id) {			

				this.form.submit('post', `/order-step-2/${id}`);

			},

			onUpdate() {

				this.form.submit('put', '/projects');

			},

			onDelete() {

				this.form.submit('delete', '/projects');

			}

		}

	});

});