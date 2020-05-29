
$('.proceed').click(function() {
    $("html, body").delay(1000).animate({ scrollTop: $(document).height() }, 1000);
});

    $(document).ready(function() {

      $('#show-items').hide();
      $('#pending-orders').hide();
      $('#pending-orders-old').hide();

      $('#next').click(function() {
          $('#show-items').show();          
          $(this).hide();
      });

      $('#proceed_to_order').click(function() {
          var total = $('#total').text();
          $('#payable').text(total);
      });

      $('.btn-success').click(function() {
          var id = $(this).attr('id');
          var item = $(this).attr('item');
          var price = $(this).attr('price');
          
          var quantity = $('.qty_'+id).val();
          $('.qty').text('Quantity: '+quantity);
          $('input[name=qty]').val(quantity);
          $('input[name=item_id]').val($(this).val());
          $('input[name=item]').val(item);
          $('input[name=price]').val(price);
          $('.price_total').text('Ordered Total: '+parseFloat(price) * parseInt(quantity));


          storevalue(id);
      });

      function storevalue(id){
          var className = document.getElementsByClassName('attr_'+id);
          var classnameCount = className.length;
          var ValueStore = new Array();
          for(var j = 0; j < classnameCount; j++){
              
              ValueStore.push(className[j].value);
          }
          console.log(ValueStore);
          console.log(classnameCount);

          localStorage.setItem('attributes', ValueStore);
      }

      $('#dealer_id').on('change', function() {

        var id = $(this).val();

        $('input[name=dealer]').val(id);       

        $('#show-items').hide();

        $('#pending-orders').hide();

      });

      $('.proceed').click(function(e) {
          $('.modal').modal('hide');
      });

      $('#submit_order').click(function() {
          $('#confirm_order').modal('toggle');
      });

    });
