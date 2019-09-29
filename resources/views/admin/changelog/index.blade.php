@extends('themes.limitless.layouts.default')

@section('load')
@endsection

@section('pageheader')
<div class="page-header-content header-element-md-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Changelog</span></h4>
    </div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
        {{ Breadcrumbs::render('changelog') }}
    </div>
</div>
<!-- /page header -->
@endsection

@section('content')

<div>
    <h5 class="content-group font-weight-semibold">
        <i class="icon-github"></i> <a href="https://github.com/Acepmon" target="_blank">Acepmon</a> / <a href="https://github.com/Acepmon/g-framework" target="_blank">G-Framework</a>
        <br><small class="text-muted">Branch: <strong>Master</strong></small>
    </h5>
</div>

<div class="card card-body border-top-teal">
    <div class="list-feed">

        @foreach ($commits as $item)
        <div class="list-feed-item">
            <div class="text-muted">{{ date('Y-m-d', strtotime($item['commit']['author']['date'])) }}</div>
            <strong>{{$item['commit']['author']['name']}}</strong>: {{$item['commit']['message']}}
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('script')
@endsection
