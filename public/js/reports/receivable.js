$('input[name="category"]').click(function(e) {        
    if (e.target.checked) {
      localStorage.setItem('category', true);

      $('.category').show();
    } else {
      localStorage.setItem('category', false);

      $('.category').hide();
    }
  });
  $('input[name="dealer_name"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('dealer_name', true) : localStorage.setItem('dealer_name', false);
    if (e.target.checked) {
      localStorage.setItem('dealer_name', true)

      $('.dealer_name').show();
    } else {
      localStorage.setItem('dealer_name', false)

      $('.dealer_name').hide();
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
  $('input[name="dealer_group"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('dealer_group', true) : localStorage.setItem('dealer_group', false);
    if (e.target.checked) {
      localStorage.setItem('dealer_group', true)

      $('.dealer_group').show();
    } else {
      localStorage.setItem('dealer_group', false)

      $('.dealer_group').hide();
    }
  });
  $('input[name="item_name"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('item_name', true) : localStorage.setItem('item_name', false);
    if (e.target.checked) {
      localStorage.setItem('item_name', true)

      $('.item_name').show();
    } else {
      localStorage.setItem('item_name', false)

      $('.item_name').hide();
    }
  });
  $('input[name="tra"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('tra', true) : localStorage.setItem('tra', false);
    if (e.target.checked) {
      localStorage.setItem('tra', true)

      $('.tra').show();
    } else {
      localStorage.setItem('tra', false)

      $('.tra').hide();
    }
  });
  $('input[name="gross_selling"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('gross_selling', true) : localStorage.setItem('gross_selling', false);
    if (e.target.checked) {
      localStorage.setItem('gross_selling', true)

      $('.gross_selling').show();
    } else {
      localStorage.setItem('gross_selling', false)

      $('.gross_selling').hide();
    }
  });
  $('input[name="cash_payment"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('cash_payment', true) : localStorage.setItem('cash_payment', false);
    if (e.target.checked) {
      localStorage.setItem('cash_payment', true)

      $('.cash_payment').show();
    } else {
      localStorage.setItem('cash_payment', false)

      $('.cash_payment').hide();
    }
  });
  $('input[name="date_created"]').click(function(e) {
    e.target.checked == true ? localStorage.setItem('date_created', true) : localStorage.setItem('date_created', false);
    if (e.target.checked) {
      localStorage.setItem('date_created', true)

      $('.date_created').show();
    } else {
      localStorage.setItem('date_created', false)

      $('.date_created').hide();
    }
  });

  $(document).ready(function() {
        // localStorage.clear();
        $('#excel').on('click', function() {
          var range = $('#range').val();
          var keyword = $('input[name=keyword]').val();

          $('input[name="range_excel"]').val(range);
          $('input[name="keyword_excel"]').val(keyword_excel);
          $('input[name="day_excel"]').val(day);
          $('input[name="month_excel"]').val(month);
          $('input[name="week_excel"]').val(week);
        });

        $('#range').on('change', function() {
          var range = $(this).val();

          if (range == 'daily') {
            $('.day').show();                
          } else {
            $('.day').hide();
            $('input[name=day]').val('');
          }
          if (range == 'weekly') {
            $('.week').show();
          } else {
            $('.week').hide();
            $('input[name=week]').val('');
          }
          if (range == 'monthly') {
            $('.month').show();
          } else {
            $('.month').hide();
            $('input[name=month]').val('');
          }

        });            

        localStorage.getItem('category') == null ? $('input[name="category"]').prop('checked', true) : '';

        localStorage.getItem('dealer_group') == null ? $('input[name="dealer_group"]').prop('checked', true) : '';
        localStorage.getItem('item_name') == null ? $('input[name="item_name"]').prop('checked', true) : '';
        localStorage.getItem('tra') == null ? $('input[name="tra"]').prop('checked', true) : '';
        localStorage.getItem('gross_selling') == null ? $('input[name="gross_selling"]').prop('checked', true) : '';
        localStorage.getItem('cash_payment') == null ? $('input[name="cash_payment"]').prop('checked', true) : '';

        localStorage.getItem('dealer_name') == null ? $('input[name="dealer_name"]').prop('checked', true) : '';
        localStorage.getItem('dealer_discount') == null ? $('input[name="dealer_discount"]').prop('checked', true) : '';
        localStorage.getItem('store_profit') == null ? $('input[name="store_profit"]').prop('checked', true) : '';
        localStorage.getItem('net_amount') == null ? $('input[name="net_amount"]').prop('checked', true) : '';
        localStorage.getItem('available') == null ? $('input[name="available"]').prop('checked', true) : '';
        localStorage.getItem('date_created') == null ? $('input[name="date_created"]').prop('checked', true) : '';

        if (localStorage.getItem('category') == 'true') { 
          $('input[name="category"]').prop('checked', true);
          $('.category').show();
        } 
        else if(localStorage.getItem('category') == 'false') { 
          $('input[name="category"]').prop('checked', false);
          $('.category').hide();
        }

        if (localStorage.getItem('dealer_name') == 'true') { 
          $('input[name="dealer_name"]').prop('checked', true);
          $('.dealer_name').show();
        } 
        else if(localStorage.getItem('dealer_name') == 'false') { 
          $('input[name="dealer_name"]').prop('checked', false);
          $('.dealer_name').hide();
        }

        if (localStorage.getItem('item_name') == 'true') { 
          $('input[name="item_name"]').prop('checked', true);
          $('.item_name').show();
        } 
        else if(localStorage.getItem('item_name') == 'false') { 
          $('input[name="item_name"]').prop('checked', false);
          $('.item_name').hide();
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

        if (localStorage.getItem('dealer_group') == 'true') { 
          $('input[name="dealer_group"]').prop('checked', true);
          $('.dealer_group').show(); 
        } 
        else if(localStorage.getItem('dealer_group') == 'false') { 
          $('input[name="dealer_group"]').prop('checked', false);
          $('.dealer_group').hide();
        }

        if (localStorage.getItem('gross_selling') == 'true') { 
          $('input[name="gross_selling"]').prop('checked', true);
          $('.gross_selling').show(); 
        } 
        else if(localStorage.getItem('gross_selling') == 'false') { 
          $('input[name="gross_selling"]').prop('checked', false);
          $('.gross_selling').hide();
        }

        if (localStorage.getItem('tra') == 'true') { 
          $('input[name="tra"]').prop('checked', true);
          $('.tra').show(); 
        } 
        else if(localStorage.getItem('tra') == 'false') { 
          $('input[name="tra"]').prop('checked', false);
          $('.tra').hide();
        }

        if (localStorage.getItem('cash_payment') == 'true') { 
          $('input[name="cash_payment"]').prop('checked', true);
          $('.cash_payment').show(); 
        } 
        else if(localStorage.getItem('cash_payment') == 'false') { 
          $('input[name="cash_payment"]').prop('checked', false);
          $('.cash_payment').hide();
        }
        if (localStorage.getItem('date_created') == 'true') { 
          $('input[name="date_created"]').prop('checked', true);
          $('.date_created').show(); 
        }
        else if(localStorage.getItem('date_created') == 'false') { 
          $('input[name="date_created"]').prop('checked', false);
          $('.date_created').hide();
        }

      });