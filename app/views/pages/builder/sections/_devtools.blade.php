<input type="hidden" name="ngrok[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$section_name.'.name') }}</h1>
</div>

<!-- extras settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Local Tunnel</h3>
            </div>

            <div class="panel-body">
                <!-- ngrok install -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="devtools-ngrok-install">
                            <input type="checkbox" id="devtools-ngrok-install" name="ngrok[install]" checked="{{ $section->param('ngrok_install') ? 'checked' : '' }}" value="{{ $section->param('ngrok_install') }}">
                            Install Ngrok
                        </label>

                        <p class="help-block">
                            <a href="https://ngrok.com/" target="_blank">Ngrok</a> will be available as a system service: <code>$ ngrok</code>
                        </p>
                    </div>
                </div>
                <!-- end ngrok install -->
                
            </div>
        </div>
    </div>
</div>
<!-- end extras settings -->

@include('pages.builder._continue')

@include('pages.builder._create')
