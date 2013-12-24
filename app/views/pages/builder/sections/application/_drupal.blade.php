<div class="row" id="application-drupal-{{ $appid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Drupal</h3>
            </div>

            <div class="panel-body">
                <!-- install / name -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-drupal-{{ $appid }}-name">Name</label>
                        <input type="text" id="application-drupal-{{ $appid }}-name" name="applications[drupal][{{ $appid }}][name]" placeholder="{{ $type == 'template' ? $section->param('drupal_name') : $vhost['name'] }}" value="{{ $type == 'template' ? $section->param('drupal_name') : $vhost['name'] }}" class="form-control">

                        <p class="help-block">
                        The name of this application for your own reference.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-drupal-{{ $appid }}-install">
                            <input type="checkbox" id="application-drupal-{{ $appid }}-install" name="applications[drupal][{{ $appid }}][install]" {{ $type == 'template' ? ($section->param('drupal_install') ? 'checked="checked"' : '') : ($vhost['install'] ? 'checked="checked"' : '') }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off this drupal installation.
                        </p>
                    </div>
                </div>
                <!-- end install / name -->

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-drupal-{{ $appid }}-path">Document Root</label>
                        <input type="text" id="application-drupal-{{ $appid }}-path" name="applications[drupal][{{ $appid }}][path]" placeholder="{{ $type == 'template' ? $section->param('drupal_path') : $vhost['path'] }}" value="{{ $type == 'template' ? $section->param('drupal_path') : $vhost['path'] }}" class="form-control">

                        <p class="help-block">Location of your site's index.php file, or other landing page. This should match the <code>document root</code> from <a href="#section-webserver"  data-toggle="tab">apache or nginx</a> settings.</p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-drupal-{{ $appid }}-dbname">Database Name</label>
                        <input type="text" id="application-drupal-{{ $appid }}-dbname" name="applications[drupal][{{ $appid }}][dbname]" placeholder="{{ $type == 'template' ? $section->param('drupal_dbname') : $vhost['dbname'] }}" value="{{ $type == 'template' ? $section->param('drupal_dbname') : $vhost['dbname'] }}" class="form-control">

                        <p class="help-block">The MySQL database name. Make sure you create a matching database in the <a href="#section-datastore" data-toggle="tab">mysql section</a> or it will not work.</p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-drupal-{{ $appid }}-drupalversion">Drupal Version</label>
                        <input type="text" id="application-drupal-{{ $appid }}-drupalversion" name="applications[drupal][{{ $appid }}][drupalversion]" placeholder="{{ $type == 'template' ? $section->param('drupal_version') : $vhost['drupalversion'] }}" value="{{ $type == 'template' ? $section->param('drupal_version') : $vhost['drupalversion'] }}" class="form-control">

                        <p class="help-block">The drupal version number that you wish to install.</p>
                    </div>
                </div>

                <!-- admin -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-drupal-{{ $appid }}-useremail">Admin Email</label>
                        <input type="text" id="application-drupal-{{ $appid }}-useremail" name="applications[drupal][{{ $appid }}][useremail]" placeholder="{{ $type == 'template' ? $section->param('drupal_user_email') : $vhost['useremail'] }}" value="{{ $type == 'template' ? $section->param('drupal_user_email') : $vhost['useremail'] }}" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-drupal-{{ $appid }}-username">Admin Name</label>
                        <input type="text" id="application-drupal-{{ $appid }}-username" name="applications[drupal][{{ $appid }}][username]" placeholder="{{ $type == 'template' ? $section->param('drupal_user_name') : $vhost['username'] }}" value="{{ $type == 'template' ? $section->param('drupal_user_name') : $vhost['username'] }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="application-drupal-{{ $appid }}-userpass">Admin Password</label>
                        <input type="text" id="application-drupal-{{ $appid }}-userpass" name="applications[drupal][{{ $appid }}][userpass]" placeholder="{{ $type == 'template' ? $section->param('drupal_user_pass') : $vhost['userpass'] }}" value="{{ $type == 'template' ? $section->param('drupal_user_pass') : $vhost['userpass'] }}" class="form-control">
                    </div>
                </div>
                <!-- end admin -->

                <!-- modules -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-drupal-{{ $appid }}-preinstall">Drupal Modules</label>
                        <select id="application-drupal-{{ $appid }}-preinstall" name="applications[drupal][{{ $appid }}][modules][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type == 'template')
                        	@foreach($section->param('drupal_modules') as $cmd)
                            <option value="{{ $cmd }}" selected="selected">{{ $cmd }}</option>
                            @endforeach
                        @else
                            @foreach($vhost['modules'] as $cmd)
                            <option value="{{ $cmd }}" selected="selected">{{ $cmd }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                </div>
                <!-- end modules -->

                @if ($type == 'template')
                <p>
                    The latest version of <code>drush</code> is automatically included and used to install drupal.
                </p>
                @endif

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#application-drupal-{{ $appid }}" data-template-id="{{ $appid }}">Remove this application</button>
                </p>
            </div>

        </div>
    </div>
</div>