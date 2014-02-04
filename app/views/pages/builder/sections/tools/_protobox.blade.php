<!-- protobox settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Protobox Dashboard</h3>
            </div>

            <div class="panel-body">
                <!-- install -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="protobox-dashboard-install">
                            <input type="checkbox" id="protobox-dashboard-install" name="protobox[dashboard][install]" {{ Input::old('protobox.dashboard.install', $section->param('protobox_dashboard_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the protobox dashboard installation.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="protobox-dashboard-path">License Key</label>
                        <input type="text" id="protobox-dashboard-path" name="protobox[dashboard][path]" value="{{ Input::old('protobox.dashboard.path', $section->param('protobox_dashboard_path')) }}" class="form-control">

                        <p class="help-block">
                        The default path to install the dashboard. Virtualhosts will point to this path.
                        </p>
                    </div>
                </div>
                <!-- end install -->
            </div>
        </div>
    </div>
</div>
<!-- end protobox settings -->
