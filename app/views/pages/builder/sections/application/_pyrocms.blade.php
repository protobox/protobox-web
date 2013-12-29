<div class="row" id="application-pyrocms-{{ $appid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">PyroCMS #{{ $type != 'template' ? (int) $appid + 1 : '{appnewid}' }}</h3>
            </div>

            <div class="panel-body">
                <!-- install / name -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-pyrocms-{{ $appid }}-name">Name</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-name" name="applications[pyrocms][{{ $appid }}][name]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_name') : $app['name'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_name') : $app['name'] }}" class="form-control">

                        <p class="help-block">
                        The name of this application for your own reference.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-pyrocms-{{ $appid }}-install">
                            <input type="checkbox" id="application-pyrocms-{{ $appid }}-install" name="applications[pyrocms][{{ $appid }}][install]" {{ $type == 'template' ? ($section->param('pyrocms_install') ? 'checked="checked"' : '') : (isset($app['install']) && $app['install'] ? 'checked="checked"' : '') }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off this pyrocms installation.
                        </p>
                    </div>
                </div>
                <!-- end install / name -->

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-pyrocms-{{ $appid }}-path">Document Root</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-path" name="applications[pyrocms][{{ $appid }}][path]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_path') : $app['path'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_path') : $app['path'] }}" class="form-control">

                        <p class="help-block">Location of your site's index.php file, or other landing page. This should match the <code>document root</code> from <a href="#" data-tab-switch="sel-webserver">apache or nginx</a> settings.</p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-pyrocms-{{ $appid }}-dbname">Database Name</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-dbname" name="applications[pyrocms][{{ $appid }}][dbname]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_dbname') : $app['dbname'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_dbname') : $app['dbname'] }}" class="form-control">

                        <p class="help-block">The MySQL database name. Make sure you create a matching database in the <a href="#" data-tab-switch="sel-datastore">mysql section</a> or it will not work.</p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-pyrocms-{{ $appid }}-version">PyroCMS Version</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-version" name="applications[pyrocms][{{ $appid }}][version]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_version') : $app['version'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_version') : $app['version'] }}" class="form-control">

                        <p class="help-block">The pyrocms version number you wish to install. <a href="https://github.com/pyrocms/pyrocms/releases" target="_blank">Compatible version numbers</a>.</p>
                    </div>
                </div>

                <!-- admin -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-pyrocms-{{ $appid }}-firstname">Admin First Name</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-firstname" name="applications[pyrocms][{{ $appid }}][firstname]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_firstname') : $app['firstname'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_firstname') : $app['firstname'] }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="application-pyrocms-{{ $appid }}-lastname">Admin Last Name</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-lastname" name="applications[pyrocms][{{ $appid }}][lastname]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_lastname') : $app['lastname'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_lastname') : $app['lastname'] }}" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-pyrocms-{{ $appid }}-email">Admin Email</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-email" name="applications[pyrocms][{{ $appid }}][email]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_email') : $app['email'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_email') : $app['email'] }}" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-pyrocms-{{ $appid }}-username">Admin Username</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-username" name="applications[pyrocms][{{ $appid }}][username]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_username') : $app['username'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_username') : $app['username'] }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="application-pyrocms-{{ $appid }}-password">Admin Password</label>
                        <input type="text" id="application-pyrocms-{{ $appid }}-password" name="applications[pyrocms][{{ $appid }}][password]" placeholder="{{ $type == 'template' ? $section->param('pyrocms_password') : $app['password'] }}" value="{{ $type == 'template' ? $section->param('pyrocms_password') : $app['password'] }}" class="form-control">
                    </div>
                </div>
                <!-- end admin -->

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#application-pyrocms-{{ $appid }}" data-template-id="{{ $appid }}">Remove this application</button>
                </p>
            </div>

        </div>
    </div>
</div>