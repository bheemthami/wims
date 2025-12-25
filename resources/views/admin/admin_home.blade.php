<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-image"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Banners </span>
                <span class="info-box-number">{{ $count['banners'] }}<small> records </small></span>
                <a href="{{ route('banners.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-file-text-o"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Pages </span>
                <span class="info-box-number">{{ $count['pages'] }}<small> records </small></span>
                <a href="{{ route('pages.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-pencil-square-o"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Posts </span>
                <span class="info-box-number">{{ $count['posts'] }}<small> records </small></span>
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-file"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Publications </span>
                <span class="info-box-number">{{ $count['documents'] }}<small> records </small></span>
                <a href="{{ route('documents.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div>


    {{-- <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-graduation-cap"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Programs </span>
                <span class="info-box-number">{{ $count['programs'] }}<small> records </small></span>
                <a href="{{ route('programs.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div> --}}

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-black-tie"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Faculties </span>
                <span class="info-box-number">{{ $count['officials'] }}<small> records </small></span>
                <a href="{{ route('officials.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-building"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Facilities </span>
                <span class="info-box-number">{{ $count['facilities'] }}<small> records </small></span>
                <a href="{{ route('facilities.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-folder"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Gallery </span>
                <span class="info-box-number">{{ $count['galleries'] }}<small> records </small></span>
                <a href="{{ route('galleries.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fa fa-external-link"> </i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Quick Links</span>
                <span class="info-box-number">{{ $count['quick_links'] }}<small> records </small></span>
                <a href="{{ route('quick-links.index') }}" class="btn btn-sm btn-warning">view records</a>
            </div>
        </div>
    </div>
</div>
