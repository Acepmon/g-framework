@extends('themes.limitless.layouts.default')

@section('title', 'Localization Details')

@section('load-before')

@endsection

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/editors/ace/ace.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.localizations.includes.pageheader', ['breadcrumb' => 'localizations_show'])
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {!! session('status') !!}
    </div>
@endif

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Localization Details</h6>

        <div class="header-elements">
            <a href="#modal_delete_locale" data-toggle="modal" class="btn btn-light btn-sm"><span class="icon-trash mr-2"></span> Delete Localization</a>
        </div>
    </div>

    <table class="table table-sm">
        <tbody>
            <tr>
                <td>
                    @if (isset($localization->localeImg))
                        <img src="{{ $localization->localeImg }}" alt="" style="width: 30px; height: auto;">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.localizations.show', $localization->locale) }}">
                        {{ $localization->localeName }}
                    </a>
                </td>
                <td><strong>{{ $localization->files->count() }}</strong> Locale Files</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="card">
    <div class="row no-gutters">
        <div class="col-sm-3">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Locales ({{ $localization->files->count() }})</h6>

                <div class="header-elements">
                    @if ($localization->files->count() > 0)
                        <button type="button" class="btn btn-light btn-sm mr-1" title="Delete Locale File" id="deleteLocaleBtn" data-toggle="modal" data-target="#modal_delete_locale_file" data-file="{{ $localization->files->first()->name }}" data-initial-text='<span class="icon-trash"></span>' data-loading-text='<span class="icon-spinner spinner"></span>'>
                            <span class="icon-trash"></span>
                        </button>
                    @endif
                    <div class="btn-group">
                        @if ($localization->files->count() > 0)
                            <button type="button" class="btn btn-light btn-sm" title="Save Locale File" id="saveLocaleBtn" data-file="{{ $localization->files->first()->name }}" data-initial-text='<span class="icon-floppy-disk"></span>' data-loading-text='<span class="icon-spinner spinner"></span>'>
                                <span class="icon-floppy-disk"></span>
                            </button>
                        @endif
                        <button type="button" class="btn btn-light btn-sm" title="Create Locale File" id="createLocaleBtn" data-toggle="modal" data-target="#modal_create_locale_file" data-initial-text='<span class="icon-plus3"></span>' data-loading-text='<span class="icon-spinner spinner"></span>'>
                            <span class="icon-plus3"></span>
                        </button>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0 flex-nowrap overflow-auto pb-1" style="max-height: 378px;">
                @foreach ($localization->files as $index => $file)
                    <li class="nav-item"><a href="#vertical-left-tab-{{ $file->name }}" class="nav-link {{ $index == 0 ? 'active' : '' }}" data-toggle="tab" data-file="{{$file->name}}">{{ $file->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-9">
            <div class="tab-content">
                @foreach ($localization->files as $index => $file)
                    <div class="tab-pane fade{{ $index == 0 ? ' show active' : '' }}" id="vertical-left-tab-{{ $file->name }}">
                        <div id="{{$file->name}}_editor">{{ file_get_contents($file->filepath) }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div id="modal_create_locale_file" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('admin.localizations.store') }}" method="POST">
            @csrf
            <input type="text" name="locale" id="locale" value="{{ $localization->locale }}" hidden>

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Locale File</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" placeholder="about_us..." name="name" id="name" required>
                        <span class="form-text text-muted">Name will be converted to <strong>snake</strong> case on submit</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_delete_locale_file" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('admin.localizations.destroy', $localization->locale) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to delete locale file?</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Choose File</label>
                        <select name="name" id="name" class="form-control" required>
                            <option></option>
                            @foreach ($localization->files as $file)
                                <option value="{{ $file->name }}">{{ $file->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_delete_locale" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('admin.localizations.destroy', $localization->locale) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Localization</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>
                        Are you sure you want to delete this localization?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var str = '{!! json_encode($localization->files->map(function ($item) { $item->filepath = null; return $item; })) !!}';
        var list = JSON.parse(str);
        var objects = {};
        list.forEach(item => {
            var php_editor = ace.edit(item.name + "_editor");
                php_editor.setTheme("ace/theme/monokai");
                php_editor.getSession().setMode("ace/mode/php");
                php_editor.setShowPrintMargin(false);
                php_editor.commands.addCommand({
                    name: 'save',
                    bindKey: {win: "Ctrl-S", "mac": "Cmd-S"},
                    exec: function() {
                        $("#saveLocaleBtn").trigger('click');
                    }
                });
            objects[item.name] = php_editor;
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            e.target // newly activated tab
            e.relatedTarget // previous active tab
            $("#saveLocaleBtn").data('file', $(e.target).data('file'));
        });

        $('#saveLocaleBtn').on('click', function () {
            var btn = $(this),
                initialText = btn.data('initial-text'),
                loadingText = btn.data('loading-text');
            btn.html(loadingText).addClass('disabled');

            var target = $(this).data('file');
            var content = objects[target].getSession().getValue();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route("admin.localizations.update", $localization->locale)}}',
                type: "PUT",
                data: {
                    name: target,
                    content: content
                },
                success: function () {
                    btn.html(initialText).removeClass('disabled');
                    alert('Successfully Saved!');
                },
                error: function () {
                    alert('Failed to save!');
                }
            });
        });

    });
</script>
@endsection

