@foreach($categories as $category)
    <tr>
        <td>{{$category->name}}</td>
        <td>
            <img src="/storage/avatars/{{ $category->photo }}" alt="item" class="" style="width: 50px"  >
        </td>
        <td>
              
          <span class="edit-container">
              <a href="{{ route('category.edit', [$category->id]) }}" class="btn btn-success btn-sm radius">
                <i class="fa fa-pencil"></i> edit
              </a>
          </span>
          &nbsp;
          <span class="delete-container">

            <button data-toggle="modal" data-target="#confirm_{{$category->id}}" type="button" class="btn btn-danger btn-sm radius"><i class="fa fa-trash"></i> Delete</button>

             {{ Form::model($category, array('route' => array('category.destroy', $category->id), 'method' => 'delete')) }}
                
                @include('include.modals.confirm', ['id' => $category->id, 'data' => $category->name])                         

             {{ Form::close() }}
             
          </span>
              
        </td>
    </tr>                                           

@endforeach