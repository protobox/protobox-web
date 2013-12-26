<div class="row" id="application-lemonstand-{{ $appid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Lemonstand #{{ $type != 'template' ? (int) $appid + 1 : '{appnewid}' }}</h3>
            </div>

            <div class="panel-body">
                <!-- install / name -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-name">Name</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-name" name="applications[lemonstand][{{ $appid }}][name]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_name') : $app['name'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_name') : $app['name'] }}" class="form-control">

                        <p class="help-block">
                        The name of this application for your own reference.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-install">
                            <input type="checkbox" id="application-lemonstand-{{ $appid }}-install" name="applications[lemonstand][{{ $appid }}][install]" {{ $type == 'template' ? ($section->param('lemonstand_install') ? 'checked="checked"' : '') : (isset($app['install']) && $app['install'] ? 'checked="checked"' : '') }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off this lemonstand installation.
                        </p>
                    </div>
                </div>
                <!-- end install / name -->

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-lemonstand-{{ $appid }}-path">Document Root</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-path" name="applications[lemonstand][{{ $appid }}][path]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_path') : $app['path'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_path') : $app['path'] }}" class="form-control">

                        <p class="help-block">Location of your site's index.php file, or other landing page. This should match the <code>document root</code> from <a href="#" data-tab-switch="sel-webserver">apache or nginx</a> settings.</p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-dbname">Database Name</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-dbname" name="applications[lemonstand][{{ $appid }}][dbname]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_dbname') : $app['dbname'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_dbname') : $app['dbname'] }}" class="form-control">

                        <p class="help-block">The MySQL database name. Make sure you create a matching database in the <a href="#" data-tab-switch="sel-datastore">mysql section</a> or it will not work.</p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-encryption">Encryption Key</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-encryption" name="applications[lemonstand][{{ $appid }}][encrypt]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_encrypt') : $app['encrypt'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_encrypt') : $app['encrypt'] }}" class="form-control">

                        <p class="help-block">The lemonstand encryption key you want to use to encrypt data in the database.</p>
                    </div>
                </div>

                <!-- admin -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-firstname">Admin First Name</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-firstname" name="applications[lemonstand][{{ $appid }}][firstname]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_firstname') : $app['firstname'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_firstname') : $app['firstname'] }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-lastname">Admin Last Name</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-lastname" name="applications[lemonstand][{{ $appid }}][lastname]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_lastname') : $app['lastname'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_lastname') : $app['lastname'] }}" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-lemonstand-{{ $appid }}-email">Admin Email</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-email" name="applications[lemonstand][{{ $appid }}][email]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_email') : $app['email'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_email') : $app['email'] }}" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-username">Admin Username</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-username" name="applications[lemonstand][{{ $appid }}][username]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_username') : $app['username'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_username') : $app['username'] }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-password">Admin Password</label>
                        <input type="text" id="application-lemonstand-{{ $appid }}-password" name="applications[lemonstand][{{ $appid }}][password]" placeholder="{{ $type == 'template' ? $section->param('lemonstand_password') : $app['password'] }}" value="{{ $type == 'template' ? $section->param('lemonstand_password') : $app['password'] }}" class="form-control">
                    </div>
                </div>
                <!-- end admin -->

                <!-- install / name -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-defaulttheme">
                            <input type="checkbox" id="application-lemonstand-{{ $appid }}-defaulttheme" name="applications[lemonstand][{{ $appid }}][defaulttheme]" {{ $type == 'template' ? ($section->param('lemonstand_defaulttheme') ? 'checked="checked"' : '') : (isset($app['defaulttheme']) && $app['defaulttheme'] ? 'checked="checked"' : '') }} value="1">
                            Import Default Theme
                        </label>

                        <p class="help-block">
                        Import the default lemonstand theme.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-defaulttwig">
                            <input type="checkbox" id="application-lemonstand-{{ $appid }}-defaulttwig" name="applications[lemonstand][{{ $appid }}][defaulttwig]" {{ $type == 'template' ? ($section->param('lemonstand_defaulttwig') ? 'checked="checked"' : '') : (isset($app['defaulttwig']) && $app['defaulttwig'] ? 'checked="checked"' : '') }} value="1">
                            Import Default Twig Theme
                        </label>

                        <p class="help-block">
                        Import the default lemonstand twig theme.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-lemonstand-{{ $appid }}-demodata">
                            <input type="checkbox" id="application-lemonstand-{{ $appid }}-demodata" name="applications[lemonstand][{{ $appid }}][demodata]" {{ $type == 'template' ? ($section->param('lemonstand_demodata') ? 'checked="checked"' : '') : (isset($app['demodata']) && $app['demodata'] ? 'checked="checked"' : '') }} value="1">
                            Import Demo Data
                        </label>

                        <p class="help-block">
                        Import the lemonstand demo data.
                        </p>
                    </div>
                </div>
                <!-- end install / name -->

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#application-lemonstand-{{ $appid }}" data-template-id="{{ $appid }}">Remove this application</button>
                </p>
            </div>

        </div>
    </div>
</div>