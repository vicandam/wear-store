
Vue.component('modal', {
  template: '#modal-template'
})

new Vue({

  el: '#vue-wrapper',

  data: {
    dealers: [],
    orders: [],
    pending: [],    

    credit_balance: '',
    credit_limit: '',
    dealer_name: '',
    dealer_id: '',
    order_id: '',
    status: '',
    price: '',
    item: '',
    amount: '',
    total_order_in_cart: '',

    hasNoCredit: true,
    showError: false,
    noPending: true,       

    newItems: {'item':'', 'price': '', 'qty': '', 'item_id': '', 'dealer_id': '', 'attributes': []}
  },

  mounted() {        
    this.getDealers();   
  },

  methods: {
    getDealersCreditLimit() {
      var id = document.getElementById('dealer_id'); 

      if (id.value != '') {
        axios.get('/dealer/' + id.value).then(

          response => {
            this.hasNoCredit = (response.data <= 0 ? this.hasNoCredit = true : this.hasNoCredit = false);
            this.showError = (response.data <= 0 ? this.showError = true : this.showError = false);
            this.credit_balance = response.data.credit_balanced;
            this.credit_limit = response.data.credit_limit;
            this.dealer_name = response.data.user.name;        
          }).catch(error => {
            this.hasNoCredit = true;
            this.showError = false;
          });
        } else {
          this.hasNoCredit = true;
          this.showError = false;
        }

        this.pendingOrders(id, false);
      },

      pendingOrders: function pendingOrders(id, deleteStatus)
      {     
        axios.get('/getpending-order/' + id.value).then(

          (response) => {
            console.log(response.data);

            response.data == false ? this.noPending = true : this.noPending = false;

            if (response.data == false ) {
              $('#pending-orders-old').hide();
              $('#next').show();        
            } 
            else 
            {
              this.pending = response.data.orders;
              this.amount = response.data.amount;

              $('#pending-orders-old').show();
              $('#next').hide();
            }

          });
      },

      removePendingOrder: function removePendingOrder(id, order_id, item_id, price, quantity) {

        var dealer_id = document.getElementById('dealer_id');     

        axios.delete('/delete-order/' + id, {data: {orderid: order_id, dealerid: dealer_id.value, itemid: item_id, price: price, quantity: quantity} }).then(
          (response) => {
            if (response.data.deleted == 'deleted') {
              if (response.data.pending == 'false') {
                // Hide pending table
                this.pendingOrders(dealer_id, true);
                $('#pending-orders-old').hide();

              } else {                
                // Reload pending orders
                this.pendingOrders(dealer_id, false);
              }   

              Command: toastr["success"]("Item deleted");

            } else {
              Command: toastr["error"]("Something went wrong!");
            }
          });
      },

      removeNewOrder: function removeNewOrder(id, order_id, item_id, price, quantity) {

        var dealer_id = document.getElementById('dealer_id');     

        axios.delete('/delete-order/' + id, {data: {orderid: order_id, dealerid: dealer_id.value, itemid: item_id, price: price, quantity: quantity} }).then(
          (response) => {

            if (response.data.deleted == 'deleted') {                                                     

              Command: toastr["success"]("Item deleted");

              this.orders = response.data;
              this.total_order_in_cart = response.data.amount;
              var new_qty = response.data.new_qty;

              $('#qty_'+item_id).text(new_qty);

              response.data.pending == 'false' ?  $('#pending-orders').hide() : '';

            } else {
              Command: toastr["error"]("Something went wrong!");
            }
          });
      },

      addOrderId() {
        var id = document.getElementById('dealer_id');        

        axios.post('/add-orderid', {dealer_id: id.value}).then(function (response) {
          this.order_id = response.data.order_id;
          localStorage.setItem('order_id', response.data.order_id);
          this.status = response.data.status;          
        });
      },

      saveOrder() {
        var item = document.getElementById('item');
        var price = document.getElementById('price');
        var qty = document.getElementById('qty');
        var item_id = document.getElementById('item_id');
        var dealer_id = document.getElementById('dealer_id');           
        var attributes = localStorage.getItem('attributes');
        var order_id = localStorage.getItem('order_id');
        
        console.log(attributes);
        console.log('order id: '+order_id);      

        this.newItems = {
          'item':item.value, 
          'price': price.value, 
          'qty': qty.value, 
          'item_id': item_id.value, 
          'dealer_id': dealer_id.value,
          'order_id': order_id,
          'attributes': attributes
        };

        axios.post('/save-items', this.newItems).then((response) => {
          if (response.data.invalid_total == "true") {
            Command: toastr["error"]("Insuffiencient dealer's credit balanced.");
          } 
          else if(response.data.invalid_quantity == "true") {
            Command: toastr["error"]("Ordered quantity is greater than the available in stock.");
          } else {
            var qty_id = document.getElementById('qty_'+response.data.item_id);
            var old_qty = (qty_id.innerHTML).trim();
            var new_qty = parseFloat(old_qty) - parseFloat(response.data.qty);

            console.log(parseFloat(old_qty));
            console.log(parseFloat(response.data.qty));
            console.log(parseFloat(new_qty));

            Command: toastr["success"]("Order has been saved successfully.");
            $('#qty_'+response.data.item_id).text(new_qty);
            $('#pending-orders').show();
          }
            // Display new orders
            this.displayNewOrders(order_id, price.value, qty.value, item.value);
        });
      },

      displayNewOrders: function displayOrders(order_id, price, qty, item) {

        axios.get('/getorderby-dealer/' + order_id).then( 
          (response) => {
            this.orders = response.data.orders;

            this.total_order_in_cart = response.data.sub_total;

          });

      },

      completeOrder: function completeOrder(order_id) {
        axios.post('/complete-order/' + order_id).then(
          (response) => {
            if (response.data == 'completed') {

              $('#pending-orders').hide();
              $('#show-items').hide();
              Command: toastr["success"]("Order completed successfully");

              $('#pending-orders-old').hide();

            } else {
              Command: toastr["error"]("Something went wrong!");
            }            
          });
      },

      getDealersLatestCredit() {
        var id = document.getElementById('dealer_id');

        axios.get('/dealer/' + id.value).then(response => this.credit_balance = response.data.credit_balanced);
      },

      getDealers: function getDealers() {        
        axios.get('/getdealers').then(response => this.dealers = response.data);      
      }
    }

  });
