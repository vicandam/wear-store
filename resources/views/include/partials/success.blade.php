@if(Session::has('flash_message'))

  <div class="alert-wrapper-fixed">

     <div role="alert" class="popup alert alert-fixed text-center {{ Session::get('alert-class', 'alert-success') }}">

          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <i class="fa fa-info-circle"></i> {{ Session::get('flash_message') }}
      </div>

  </div>

@endif