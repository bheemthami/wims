@extends('layouts.admin.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Searching </h1>
	<ol class="breadcrumb">
		<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Search</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Searching</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="col-md-12">
				<div class="filteration">
					<div class="col-md-8">
						<label class="col-md-4" for="symbol_no"> Symbol No:</label>
						<div class="form-group col-md-8">
							<input id="symbol_no" name="symbol_no" class="form-control" placeholder="Enter your symbol no" autofocus="true">
						</div>
					</div>
				</div>
				<div class="form-inline">
					<div class="pull pull-right">
						<div class="form-group">
							<button id="search-button" class="btn btn-success pull-right" type="button"> <i class="fa fa-search"></i> Search</button>
						</div>
						<div class="form-group">
							<a class="btn btn-danger pull-right" href="{{ url('admin/dashboard') }}"> <i class="fa fa-eraser"></i> Clear</a>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						<div class="form-inline">
							<div class="pull pull-left">
								Obtained Mark Details
							</div>
							<div class="pull pull-right">
								<label class="label label-warning">Enter '-' for no mark</label> <label class="label label-lg label-danger">Please verify attendance before mark entry</label>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel panel-body">
						<form id="mark_entry_form" method="POST" action="{{ route('marks.store') }}" enctype="multipart/form-data">
							{{ csrf_field() }}

							{!! Form::hidden('student_id',null,['id'=>'student-id']) !!}
							<div class="col-md-12 marks-entry">
								@foreach($subjects as $subject)
								<div id="{{$subject->id}}" class="row">
									<div class="col-md-4 form-group">
										<label>Total Full Mark  : {{ $subject->total}}</label>
										<button class="btn btn-sm btn-block btn-info" type="button">
											{{ strtoupper($subject->name) }}
										</button>
										{!! Form::hidden('mark['.$subject->short_name.'][subject_id]',$subject->id) !!}
									</div>

									<div class="col-md-2 form-group">
										<label for="name">Attendance </label><br>
										{!! Form::radio('mark['.$subject->short_name.']['.'attendance]','1',true,['class'=>'present','id'=>'attendance-'.$subject->id]) !!} 
										<label>Present</label>
										<br>
										{!! Form::radio('mark['.$subject->short_name.']['.'attendance]','0',false,['class'=>'abscent','id'=>'attendance-'.$subject->id]) !!} 
										<label>Absent</label>

									</div>

									<div class="col-md-2 form-group">
										<label for="name">TH Mark ({{ $subject->theory_fm }})<span>*</span></label>
										{!! Form::text('mark['.$subject->short_name.']['.'obt_th_mark]',null,['id'=>'th-'.$subject->id,'class'=>'form-control marks','data-parsley-required'=>'true']) !!}
										@if($errors)      
										<span class="text-danger"><i>{{$errors->first('mark.'.$subject->short_name.'.obt_th_mark')}}</i></span> 
										@endif 
									</div>
									@if($subject->only_theory == 0)
									<div class="col-md-2 form-group">
										<label for="name">PR Mark ({{ ($subject->only_theory==1)?'-':$subject->practical_fm }})<span>*</span></label>
										{!! Form::text('mark['.$subject->short_name.']['.'obt_pr_mark]',null,['id'=>'pr-'.$subject->id,'class'=>'form-control marks','data-parsley-required'=>'true']) !!}
										@if($errors)      
										<span>{{$errors->first('mark.'.$subject->short_name.'.obt_pr_mark')}}</i></span> 
										@endif 
									</div>
									@endif

									<div class="col-md-2 form-group">
										<label for="name">Obt. Total Mark <span>*</span></label>
										{!! Form::text('mark['.$subject->short_name.']['.'obt_total_mark]',null,['id'=>'total-'.$subject->id,'class'=>'form-control','readOnly'=>true]) !!} 
									</div>
								</div>
								@endforeach
								<hr>
							</div>
							<div class="form-inline">
								<div class="pull pull-right">
									<div class="form-group">
										<button class="btn btn-success pull-right" type="submit"> <i class="fa fa-search"></i> Submit</button>
									</div>
								</div>
							</div>
							<hr>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('.marks').on('change',function(e){
			e.stopPropagation();
			var subjectID = $(this).parent().parent().attr('id');
			var th_mark = $('#th-'+subjectID).val();
			var pr_mark = $('#pr-'+subjectID).val();

			if(th_mark == "" | th_mark == undefined){
				th_mark = 0;
			}

			if(pr_mark == "" | pr_mark == undefined){
				pr_mark = 0;	
			}

			var total_mark = parseFloat(th_mark) + parseFloat(pr_mark);
			$('#total-'+subjectID).val(total_mark);
		});
	});

</script>
<script>
	$(document).ready(function(){
		$('#dob').nepaliDatePicker();
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.present').change(function(){
			var ID = this.id.split('-');
			$('#th-'+ID[1]).val('');
			$('#pr-'+ID[1]).val('');
			$('#total-'+ID[1]).val('');
		});

		$('.abscent').change(function(){
			var ID = this.id.split('-');
			$('#th-'+ID[1]).val('-');
			$('#pr-'+ID[1]).val('-');
			$('#total-'+ID[1]).val('NaN');
		});	
	});
</script>
<script type="text/javascript">
	$('#search-button').click(function(){
		$('#search-button').html('<i class="fa fa-spinner fa-spin"></i> Searching...');
		var symbol_no = $('#symbol_no').val();
		var baseUrl = "<?php echo url('admin/student-search'); ?>";
		$.ajax({
			url : baseUrl,
			data : {'symbol_no':symbol_no},
			success:function(response){
				if(response.status=='error'){
					toastr.error(response.message)
				}else{
					$(document).find('#student-id').val(response.data.id); 
				}
				$('#search-button').html('<i class="fa fa-search"></i> Search');
			}
		});
	});
</script>
@endsection