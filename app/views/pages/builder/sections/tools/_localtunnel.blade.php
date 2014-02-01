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
                            <input type="checkbox" id="devtools-ngrok-install" name="ngrok[install]" {{ Input::old('newrelic.install', $section->param('ngrok_install')) ? 'checked="checked"' : '' }} value="1">
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