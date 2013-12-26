<div class="row" id="application-symfony-{{ $appid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Symfony #{{ $type != 'template' ? (int) $appid + 1 : '{appnewid}' }}</h3>
            </div>

            <div class="panel-body">
                <!-- install / name -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-symfony-{{ $appid }}-name">Name</label>
                        <input type="text" id="application-symfony-{{ $appid }}-name" name="applications[symfony][{{ $appid }}][name]" placeholder="{{ $type == 'template' ? $section->param('symfony_name') : $app['name'] }}" value="{{ $type == 'template' ? $section->param('symfony_name') : $app['name'] }}" class="form-control">

                        <p class="help-block">
                        The name of this application for your own reference.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-symfony-{{ $appid }}-install">
                            <input type="checkbox" id="application-symfony-{{ $appid }}-install" name="applications[symfony][{{ $appid }}][install]" {{ $type == 'template' ? ($section->param('symfony_install') ? 'checked="checked"' : '') : (isset($app['install']) && $app['install'] ? 'checked="checked"' : '') }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off this symfony installation.
                        </p>
                    </div>
                </div>
                <!-- end install / name -->

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-symfony-{{ $appid }}-path">Document Root</label>
                        <input type="text" id="application-symfony-{{ $appid }}-path" name="applications[symfony][{{ $appid }}][path]" placeholder="{{ $type == 'template' ? $section->param('symfony_path') : $app['path'] }}" value="{{ $type == 'template' ? $section->param('symfony_path') : $app['path'] }}" class="form-control">

                        <p class="help-block">Location of your site's index.php file, or other landing page. This should match the <code>document root</code> from <a href="#" data-tab-switch="sel-webserver">apache or nginx</a> settings.</p>
                    </div>
                </div>

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#application-symfony-{{ $appid }}" data-template-id="{{ $appid }}">Remove this application</button>
                </p>
            </div>

        </div>
    </div>
</div>