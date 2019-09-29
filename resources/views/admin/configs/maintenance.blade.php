@extends('themes.limitless.layouts.default')

@section('title', 'Maintenance Mode')

@section('load')

@endsection

@section('pageheader')
    @include('admin.configs.includes.pageheader', ['breadcrumb' => 'configs_maintenance'])
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form action="{{ route('admin.configs.maintenance.set') }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Maintenance Mode
                    </h5>
                </div>
                <div class="card-body">
                    <p>
                        When your application is in <strong>maintenance mode</strong>, aa custom view will be displayed for all requests into yourpplication.
                        This makes it easy to "disable" your application while it is updating or when you are performing maintenance.
                    </p>
                    <p>
                        If the application is in maintenance mode, error will be thrown with a status code of <strong>503</strong>.
                    </p>

                    @if ($maintenance['status'] == 'down')
                    <div class="alert alert-warning">
                        <p><strong>Warning!</strong> Your application has been in maintenance mode for {{ \Carbon\Carbon::parse($maintenance['time'])->longAbsoluteDiffForHumans() }}.</p>
                    </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group @error('status') has-error @enderror">
                        <label for="status">Maintenance Mode <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="up" {{ $maintenance['status'] == 'up' ? 'selected' : '' }}>Disabled</option>
                            <option value="down" {{ $maintenance['status'] == 'down' ? 'selected' : '' }}>Enabled</option>
                        </select>
                        @error('status')
                            <span class="help-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="emails">Email Notification Address</label>
                        <input type="text" name="emails" id="emails" class="form-control" placeholder="email@example.com, another@example.com etc" value="{{ $maintenance['emails'] }}">
                        <span class="help-block">Separate each addresses should be separated by comma. System will send email notification when maintenance mode is updated.</span>
                    </div>
                    <div id="whenDown" style="display: {{ $maintenance['status'] == 'down' ? 'block' : 'none' }};">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Upgrading Database... etc" style="resize: none;">{{ $maintenance['message'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="retry">Retry After</label>
                            <input type="text" name="retry" id="retry" class="form-control" placeholder="60" value="{{ $maintenance['retry'] }}">
                            <span class="help-block">Retry value will be set as the  Retry-After HTTP header's value</span>
                        </div>
                        <div class="form-group">
                            <label for="allowed">Allowed IP Addresses</label>
                            <input type="text" name="allowed" id="allowed" class="form-control" placeholder="127.0.0.1, 192.168.0.0/16" value="{{ $maintenance['allowed'] }}">
                            <span class="help-block">Separate each addresses should be separated by comma. Your IP address will be automatically appended to the list.</span>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#status").change(function () {
            if ($(this).val() == 'down') {
                $("#whenDown").css('display', 'block');
            } else {
                $("#whenDown").css('display', 'none');
            }
        });
    });
</script>
@endsection
