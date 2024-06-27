<div class="row">
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-files-o"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Pages </span>
				<span class="info-box-number">{{ $count['pages']}}<small> records </small></span>
				<a href="{{ route('pages.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-flag"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Banners </span>
				<span class="info-box-number">{{ $count['banners']}}<small> records </small></span>
				<a href="{{ route('banners.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-pencil-square-o"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Posts </span>
				<span class="info-box-number">{{ $count['posts']}}<small> records </small></span>
				<a href="{{ route('posts.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>


	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-calendar"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Events </span>
				<span class="info-box-number">{{ $count['events']}}<small> records </small></span>
				<a href="{{ route('events.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-graduation-cap"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Programs </span>
				<span class="info-box-number">{{ $count['programs']}}<small> records </small></span>
				<a href="{{ route('programs.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-wrench"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Trainings </span>
				<span class="info-box-number">{{ $count['trainings']}}<small> records </small></span>
				<a href="{{ route('trainings.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-black-tie"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Faculties </span>
				<span class="info-box-number">{{ $count['officials']}}<small> records </small></span>
				<a href="{{ route('officials.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-star-o"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Facilities </span>
				<span class="info-box-number">{{ $count['facilities']}}<small> records </small></span>
				<a href="{{ route('facilities.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-picture-o"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Gallery </span>
				<span class="info-box-number">{{ $count['galleries']}}<small> records </small></span>
				<a href="{{ route('galleries.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>


	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-file"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Publications </span>
				<span class="info-box-number">{{ $count['documents']}}<small> records </small></span>
				<a href="{{ route('documents.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-file"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Training Types </span>
				<span class="info-box-number">{{ $count['training_types']}}<small> records </small></span>
				<a href="{{ route('training-types.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-file"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Training Categories </span>
				<span class="info-box-number">{{ $count['training_categories']}}<small> records </small></span>
				<a href="{{ route('training-categories.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>


	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-file"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Post Categories</span>
				<span class="info-box-number">{{ $count['post_categories']}}<small> records </small></span>
				<a href="{{ route('post-categories.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-comments-o"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Testimonials</span>
				<span class="info-box-number">{{ $count['testimonials']}}<small> records </small></span>
				<a href="{{ route('testimonials.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-question-circle-o"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Visitor Queries</span>
				<span class="info-box-number">{{ $count['quick_links']}}<small> records </small></span>
				<a href="{{ route('visitor_queries.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua">
				<i class="fa fa-external-link"> </i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Quick Links</span>
				<span class="info-box-number">{{ $count['quick_links']}}<small> records </small></span>
				<a href="{{ route('quick-links.index')}}" class="btn btn-sm btn-warning">view records</a>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
</div>