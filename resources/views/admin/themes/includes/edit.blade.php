@extends('themes.limitless.layouts.default')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/js/plugins/editors/ace/ace.js') }}"></script>
@endsection

@section('pageheader')
<div class="page-header-content header-elements-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 ml-2"></i> <span class="font-weight-semibold">theme</span> Edit Page</h4>
    </div>

    <div class="heading-elements">
        <a href="#" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Button <b><i class="icon-menu7"></i></b></a>
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="/themes/"><i class="icon-home2 ml-2"></i> Home</a></li>
    </ul>
</div>
<!-- /page header -->
@endsection

@section('content')

<div class="row">
    <div class="col-sm-2">
        @include('admin.themes.sidebar')
    </div>
    <div class="col-sm-10">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Customize Include: <strong>{{ $include['text'] }}</strong></h5>

                <div class="header-elements">
                    <button type="button" data-loading-text="<i class='icon-spinner4 spinner mr-2'></i> Saving" class="btn btn-primary btn-sm btn-loading">Save File</button>
                </div>
            </div>

            <div class="card-body">
                <div id="editor">{{ File::get($include['fullPath']) }}</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        var php_editor = ace.edit("editor");
        php_editor.setTheme("ace/theme/monokai");
        php_editor.getSession().setMode("ace/mode/php");
        php_editor.setShowPrintMargin(false);
        php_editor.setOptions({
            maxLines: 100
        });


        // Buttons with progress/spinner
        // ------------------------------

        // Initialize on button click
        $('.btn-loading').click(function () {
            var btn = $(this);
            var content = php_editor.getSession().getValue();
            btn.button('loading');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route("admin.themes.includes.update", [$theme->id, $include["text"]])}}',
                type: "PUT",
                data: {
                    content: content
                },
                success: function () {
                    btn.button('reset');
                }
            });
        });
    });
</script>
@endsection
