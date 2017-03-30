<div class="btn-group">
  <a href="{{url('form/create')}}" type="button"
  @if(session('menu')=='create-form')
  class="btn btn-primary"
  @else
  class="btn btn-default"
  @endif
   >
  Create form
  </a>
  <a href="{{url('#')}}" type="button" 
  @if(session('menu')=='create-field')
  class="btn btn-primary"
  @else
  class="btn btn-default"
  @endif
   >
  Add fields
  </a>
  <a href="{{url('#')}}" type="button" 
  @if(session('menu')=='create-option')
  class="btn btn-primary"
  @else
  class="btn btn-default"
  @endif
   >
  Add Option
  </a>
</div>