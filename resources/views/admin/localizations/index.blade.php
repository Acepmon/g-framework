@extends('themes.limitless.layouts.default')

@section('title', 'Localizations')

@section('load-before')

@endsection

@section('load')

@endsection

@section('pageheader')
    @include('admin.localizations.includes.pageheader', ['breadcrumb' => 'localizations_index'])
@endsection

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Localizations</h6>

        <div class="header-elements">
            <a href="#modal_create_locale" data-toggle="modal" class="btn btn-primary btn-sm"><span class="icon-plus3 mr-2"></span> Create Localization</a>
        </div>
    </div>

    @if (session('status'))
        <div class="card-body">
            <div class="alert alert-success">
                {!! session('status') !!}
            </div>
        </div>
    @endif

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th style="width: 50px"></th>
                <th>Locale</th>
                <th>Language Files</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($localizations as $localization)
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
            @endforeach
        </tbody>
    </table>
</div>

<div id="modal_create_locale" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('admin.localizations.store') }}" method="POST">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Localization</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" placeholder="en, mn, kr..." name="name" id="name" required>
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
@endsection

@section('script')

@endsection

