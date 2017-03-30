@extends('layouts.backend-master')
@section('menu')
Value Submitted for this Form
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <h4> {{$form['title']}}</h4>
      <table class="table table-hover">
        <thead>
          <tr>
            @foreach($formFields as $formField)
            <th>{{$formField['name']}}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
        @foreach($formSubmissions as $formSubmission)
          <tr>
          @foreach($formFields as $formField)
            <?php $vlaue = '';
            $value = $formRepo->getValueByFieldIdAndSubmissionId($formField['id'],$formSubmission['id']); ?>
            <td> {{ $value }} </td>
          @endforeach
          
          </tr>
        @endforeach
        </tbody>
        
      </table>
    </form>
  </div>
  
</div>
@stop