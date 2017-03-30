@extends('layouts.backend-master')
@section('menu')
SMS
@stop
@section('content')
<div class="row">

	<div class="col-md-5 input">
   			<div class="panel panel-primary">
			<div class="panel-heading">Send Sms</div>
			<div class="panel-body" style="background-color: #f9f9f9;">

				<form method="post" action="{{url('sms/send-sms')}}">
			   		{!! csrf_field() !!}
					  <div class="form-group">
					    <label for="name">*TO:</label>

					    <input type="text" class="form-control" name="to" id="to" value="" required>
					    @if ($errors->has('to'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('to') }}</strong>
			               </span>
			            @endif
					  </div>
					  <span2></span2>
					  
					  <div class="form-group">
					    <label for="phone">*Message:</label>
					    <textarea name="message" class="form-control" rows="5">{{old('message')}}</textarea>
					    @if ($errors->has('message'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('message') }}</strong>
			               </span>
			            @endif
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
			</div>
   		</div>
	<div class="col-md-7">
   			<span><h3>Available Groups</h3></span>
   		<hr>

   			@foreach($groups as $group)
		<div class="row" style="background-color: ;padding: 5px;border-bottom: 2px groove  white;">
			<div class="col-md-12" >
				<div class="button-group">
					<a href="#{{$group['id']}}"  class="btn btn btn-outline-success" style="color: #337AB7;font-weight: 900!important; " data-toggle="collapse">{{$group['name']}}</a>
					<a type="button" class="btn btn-primary btn-sm pull-right" onclick="checkAll({{$group['id']}})"><span class="glyphicon glyphicon-check"></span></a>
				</div>
				<div id="{{$group['id']}}" class="collapse">
				    
				    
							<table class="table table-bordered" style="background-color: #f9f9f9;">
							    <thead>
							      <tr>
							        <th>Name</th>
							        <th>Email</th>
							        <th>Phone</th>
							        <th>Check/View</th>
							      </tr>
							    </thead>
							    <tbody>
							    @foreach($contacts as $contact)
							    @if($contact['group_id'] == $group['id'])
								      <tr>
								      	<td>{{$contact['first_name']}} {{$contact['middle_name']}} {{$contact['last_name']}}</td>
								        <td>{{$contact['email']}}</td>
								        <td>{{$contact['phone']}}</td>
								        <td>
								        	<div class="csvCheckbox pull-left"><input type="checkbox" class="{{$group['id']}}"  value="{{$contact['phone']}}"></div>
								        	<a href="{{url('/contact/single/view/'.$contact['id'])}}" type="button" class="btn btn-info btn-xs pull-right"><span class="glyphicon glyphicon-eye-open"></span></a>

								        </td>
								      </tr>
								      @endif
								  @endforeach
							    </tbody>
							</table>
				</div>
			</div>
			
			
			
		</div>
		@endforeach
   		</div>


	<script type="text/javascript">
	
	var email = {};
	var i=0;
	$(':checkbox').on('change',function checkEach(event){
		console.log(event);
		if($(this).prop('checked') == true)
        {
        	$(this).attr('id', i);
            email[i] = $(event.target).val();
			var htmlContent ="<span1 class='"+$(this).attr('class')+"' style='background-color:#e3eaf4;padding:5px 5px;border-right:3px solid #f9f9f9;margin-top:3px;' id='"+i+"'></span1>";
			$("span2").last().append( $(htmlContent));

			$('#'+i).text(email[i]);
			//$('#'+i).trigger('contentchanged',i);
			if($('#to').val()== ''){
  				$('#to').val($('#'+i).text());
		  		}else{
		  			$('#to').val($('#to').val()+','+$('#'+i).text());
		  	}
			i++;
			/*for positioning test*/
			var left = $('span1').last().position().left; // get left position
			var width = $('span1').last().width(); // get width;
			var right = width + left; // add the two together*/
			if((right) > 408){
				$("span1").eq(-2).append('<br/><br/>');
			}
			/*positioning ends*/
			

        }else{
        	var uncheckedEmail = $(this).val();
        	var test=new Array();
        	$( 'span1' ).each( function( index, element ){
			    if(uncheckedEmail == $( this ).text()){
			    	 $( this ).remove();
			    }
			});
			var test=new Array();
		    $( 'span1' ).each( function( index, element ){
			    test.push($( this ).text());
			});
			$('#to').val(test.join(","));
        	
        }		
	});
	$(document).on('click', 'span1', function(event){ 

		 /*for positioning test*/
			var left = $(this).position().left; // get left position
			var width = $(this).width(); // get width;
			var right = width + left; // add the two together*/
			var next = $(this).next();
			if((right+ next.width()) > 380){
				$(this).prev().append('<br/><br/>');
			}
			/*positioning ends*/

		    $(event.target).remove();
		    var checkboxId = $(this).attr('id');
		    //alert(checkboxId);
		    $('#'+checkboxId).prop("checked",false);
		    var test=new Array();
		    $( 'span1' ).each( function( index, element ){
			    test.push($( this ).text());
			});
			$('#to').val(test.join(","));
		}); 
	
	
</script>
<script>
	$('#contacts').on('change',function(){
		$('#CSV').submit();
	});
	var j = 11111;
	function checkAll(id){
		if($('.'+id).prop('checked') == false){
			$('.'+id).prop('checked',true);
			
			$('#'+id+' table tbody tr td:nth-child(4) div.csvCheckbox .'+id).each(function() {
			  var htmlContent ="<span1 class='"+id+"' style='background-color:#e3eaf4;padding:5px 5px;border-right:3px solid #f9f9f9;margin-top:3px;' id='"+(id+j)+"'></span1>";
			$("span2").last().append( $(htmlContent));
			$(this).attr('id', (id+j));
			$('#'+(id+j)).html($(this).val());
			if($('#to').val()== ''){
  				$('#to').val($('#'+(id+j)).text());
		  		}else{
		  			$('#to').val($('#to').val()+','+$('#'+(id+j)).text());
		  	}

			/*for positioning test*/
			var left = $('#'+(id+j)).position().left; // get left position
			var width = $('#'+(id+j)).width(); // get width;
			var right = width + left; // add the two together*/
			if((right) > 408){
				$("span1").last().prev().append('<br/><br/>');
			}
			/*positioning ends*/
			
			j++;
			});

		}else{
			$('.'+id).prop('checked',false);
			$('span2 .'+id).remove();
			var checkboxId = $(this).attr('id');
		    //alert(checkboxId);
		    $('.'+checkboxId).prop("checked",false);
			var test=new Array();
		    $( 'span1' ).each( function( index, element ){
			    test.push($( this ).text());
			});
			$('#to').val(test.join(","));
		}
	}
</script>
	@stop
