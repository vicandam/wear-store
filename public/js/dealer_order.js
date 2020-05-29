

new Vue({

	el: '#vue-wrapper',

	data: {

		orders: [],

		credit_limit: '',

		hasNoCredit: true,

		showError: false,

		dealer_id: '',

		order_id: '',

		newItems: {'item':'', 'price': '', 'qty': '', 'item_id': '', 'dealer_id': ''}

	},

	mounted() {			
		
		this.getDealersOrder();		

	},

	methods: {

		getDealersOrder: function getDealers() {
			
			axios.get('/getdealers-order').then(response => this.orders = response.data);			
		},

		getDealersCreditLimit() {
			var id = document.getElementById('dealer_id');			
			if (id.value != '') {
				axios.get('/dealer/' + id.value).then(

				response => { 
					this.hasNoCredit = (response.data <= 0 ? this.hasNoCredit = true : this.hasNoCredit = false);
					this.showError = (response.data <= 0 ? this.showError = true : this.showError = false);

				}).catch(error => {
					this.hasNoCredit = true;
					this.showError = false;
				});
			}
			else
			{
				this.hasNoCredit = true;
				this.showError = false;
			}

		},

		addOrderId() {
			var id = document.getElementById('dealer_id');				

			axios.post('/add-orderid', {dealer_id: id.value}).then(function (response) {
				this.order_id = response.data;
			});

		},

		saveOrder() {
			var item = document.getElementById('item');
			var price = document.getElementById('price');
			var qty = document.getElementById('qty');
			var item_id = document.getElementById('item_id');
			var dealer_id = document.getElementById('dealer_id');
			var items = this.newItems;

			this.newItems = {
				'item':item.value, 
				'price': price.value, 
				'qty': qty.value, 
				'item_id': item_id.value, 
				'dealer_id': dealer_id.value,
				'order_id': order_id
			};

			axios.post('/save-items', this.newItems).then(function (response) {
				alert(response.data);
			});

		},

		setVal(val_id, val_name) {
			this.e_id = val_id;
			this.e_name = val_name;
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