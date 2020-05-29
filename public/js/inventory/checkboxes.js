
$('input[name="category"]').click(function(e) {        
    if (e.target.checked) {
      localStorage.setItem('category', true);

      $('.category').show();
    } else {
      localStorage.setItem('category', false);

      $('.category').hide();
    }
  });
  $('input[name="name"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('name', true) : localStorage.setItem('name', false);
    if (e.target.checked) {
      localStorage.setItem('name', true)

      $('.name').show();
    } else {
      localStorage.setItem('name', false)

      $('.name').hide();
    }
  });
  $('input[name="dealer_discount"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('dealer_discount', true) : localStorage.setItem('dealer_discount', false);
    if (e.target.checked) {
      localStorage.setItem('dealer_discount', true)

      $('.dealer_discount').show(); 
    } else {
      localStorage.setItem('dealer_discount', false)

      $('.dealer_discount').hide(); 
    }
  });
  $('input[name="store_profit"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('store_profit', true) : localStorage.setItem('store_profit', false);
    if (e.target.checked) {
      localStorage.setItem('store_profit', true)

      $('.store_profit').show(); 
    } else {
      localStorage.setItem('store_profit', false)

      $('.store_profit').hide(); 
    }
  });
  $('input[name="net_amount"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('net_amount', true) : localStorage.setItem('net_amount', false);
    if (e.target.checked) {
      localStorage.setItem('net_amount', true)

      $('.net_amount').show();
    } else {
      localStorage.setItem('net_amount', false)

      $('.net_amount').hide();
    }
  });
  $('input[name="available"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('available', true) : localStorage.setItem('available', false);
    if (e.target.checked) {
      localStorage.setItem('available', true)

      $('.available').show();
    } else {
      localStorage.setItem('available', false)

      $('.available').hide();
    }
  });

  $(document).ready(function() {
    $('#category').on('change', function() {
     var category = $(this).val();
     alert('Handled');
     $('input[name=category_name]').val(category);
   });
         // localStorage.clear();
         console.log('category: '+localStorage.getItem('category')); console.log('name: '+localStorage.getItem('name'));
         localStorage.getItem('category') == null ? $('input[name="category"]').prop('checked', true) : '';
         localStorage.getItem('name') == null ? $('input[name="name"]').prop('checked', true) : '';
         localStorage.getItem('dealer_discount') == null ? $('input[name="dealer_discount"]').prop('checked', true) : '';
         localStorage.getItem('store_profit') == null ? $('input[name="store_profit"]').prop('checked', true) : '';
         localStorage.getItem('net_amount') == null ? $('input[name="net_amount"]').prop('checked', true) : '';
         localStorage.getItem('available') == null ? $('input[name="available"]').prop('checked', true) : '';

         if (localStorage.getItem('category') == 'true') { 
          $('input[name="category"]').prop('checked', true);
          $('.category').show();
        } 
        else if(localStorage.getItem('category') == 'false') { 
          $('input[name="category"]').prop('checked', false);
          $('.category').hide();
        }

        if (localStorage.getItem('name') == 'true') { 
          $('input[name="name"]').prop('checked', true);
          $('.name').show();
        } 
        else if(localStorage.getItem('name') == 'false') { 
          $('input[name="name"]').prop('checked', false);
          $('.name').hide();
        }

        if (localStorage.getItem('dealer_discount') == 'true') { 
          $('input[name="dealer_discount"]').prop('checked', true);
          $('.dealer_discount').show();          
        } 
        else if(localStorage.getItem('dealer_discount') == 'false') { 
          $('input[name="dealer_discount"]').prop('checked', false);
          $('.dealer_discount').hide();     
        }

        if (localStorage.getItem('store_profit') == 'true') { 
          $('input[name="store_profit"]').prop('checked', true); 
          $('.store_profit').show();
        } 
        else if(localStorage.getItem('store_profit') == 'false') { 
          $('input[name="store_profit"]').prop('checked', false);
          $('.store_profit').hide();
        }

        if (localStorage.getItem('net_amount') == 'true') { 
          $('input[name="net_amount"]').prop('checked', true); 
          $('.net_amount').show();
        } 
        else if(localStorage.getItem('net_amount') == 'false') { 
          $('input[name="net_amount"]').prop('checked', false);
          $('.net_amount').hide();
        }

        if (localStorage.getItem('available') == 'true') { 
          $('input[name="available"]').prop('checked', true);
          $('.available').show(); 
        } 
        else if(localStorage.getItem('available') == 'false') { 
          $('input[name="available"]').prop('checked', false);
          $('.available').hide();
        }

      });