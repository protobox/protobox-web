<div class="row" id="application-wordpress-{{ $appid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Wordpress #{{ $type != 'template' ? (int) $appid + 1 : '{appnewid}' }}</h3>
            </div>

            <div class="panel-body">
                <!-- install / name -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-wordpress-{{ $appid }}-name">Name</label>
                        <input type="text" id="application-wordpress-{{ $appid }}-name" name="applications[wordpress][{{ $appid }}][name]" placeholder="{{ $type == 'template' ? $section->param('wordpress_name') : $app['name'] }}" value="{{ $type == 'template' ? $section->param('wordpress_name') : $app['name'] }}" class="form-control">

                        <p class="help-block">
                        The name of this application for your own reference.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-wordpress-{{ $appid }}-install">
                            <input type="checkbox" id="application-wordpress-{{ $appid }}-install" name="applications[wordpress][{{ $appid }}][install]" {{ $type == 'template' ? ($section->param('wordpress_install') ? 'checked="checked"' : '') : (isset($app['install']) && $app['install'] ? 'checked="checked"' : '') }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off this wordpress installation.
                        </p>
                    </div>
                </div>
                <!-- end install / name -->

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-wordpress-{{ $appid }}-path">Document Root</label>
                        <input type="text" id="application-wordpress-{{ $appid }}-path" name="applications[wordpress][{{ $appid }}][path]" placeholder="{{ $type == 'template' ? $section->param('wordpress_path') : $app['path'] }}" value="{{ $type == 'template' ? $section->param('wordpress_path') : $app['path'] }}" class="form-control">

                        <p class="help-block">Location of your site's index.php file, or other landing page. This should match the <code>document root</code> from <a href="#" data-tab-switch="sel-webserver">apache or nginx</a> settings.</p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-wordpress-{{ $appid }}-dbname">Database Name</label>
                        <input type="text" id="application-wordpress-{{ $appid }}-dbname" name="applications[wordpress][{{ $appid }}][dbname]" placeholder="{{ $type == 'template' ? $section->param('wordpress_dbname') : $app['dbname'] }}" value="{{ $type == 'template' ? $section->param('wordpress_dbname') : $app['dbname'] }}" class="form-control">

                        <p class="help-block">The MySQL database name. Make sure you create a matching database in the <a href="#" data-tab-switch="sel-datastore">mysql section</a> or it will not work.</p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-wordpress-{{ $appid }}-version">Wordpress Version</label>
                        <input type="text" id="application-wordpress-{{ $appid }}-version" name="applications[wordpress][{{ $appid }}][version]" placeholder="{{ $type == 'template' ? $section->param('wordpress_version') : $app['version'] }}" value="{{ $type == 'template' ? $section->param('wordpress_version') : $app['version'] }}" class="form-control">

                        <p class="help-block">The wordpress version number you wish to install. <a href="http://wordpress.org/download/release-archive/" target="_blank">Compatible version numbers</a>.</p>
                    </div>
                </div>

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#application-wordpress-{{ $appid }}" data-template-id="{{ $appid }}">Remove this application</button>
                </p>
            </div>

        </div>
    </div>
</div>