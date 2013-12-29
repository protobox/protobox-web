<input type="hidden" name="php[_prevent_empty]" />
<input type="hidden" name="hhvm[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$name.'.name') }}</h1>
</div>

@if (count($section->languages()))
<ul class="nav nav-pills nav-section">
    @foreach($section->languages() as $type => $name)
    <li class="{{ $type == 'php' ? 'active' : '' }}"><a href="#section-languages-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    <div class="tab-pane active" id="section-languages-php">

        <!-- php settings -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PHP Settings</h3>
                    </div>

                    <div class="panel-body">
                        <!-- php install -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="php-install">
                                    <input type="checkbox" id="php-install" name="php[install]" {{ Input::old('php.install', $section->param('php_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install
                                </label>

                                <p class="help-block">
                                You can toggle this setting to turn on/off the PHP installation.
                                </p>
                            </div>
                        </div>
                        <!-- end php install -->

                        <!-- php version -->
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label>PHP Version</label><br>
                                @foreach($section->param('php_versions_available', []) as $version => $name)
                                <label class="radio-inline">
                                    <input type="radio" name="php[version]" value="{{ $version }}" {{ Input::old('php.version', $section->param('php_version')) == $version ? 'checked="checked"' : '' }}> {{ $name }}
                                </label>
                                @endforeach

                                <p class="help-block">
                                    Please select a PHP version that is compatible with the OS that you selected in the <a href="#" data-tab-switch="sel-vagrant">vagrant configuration</a>.
                                </p>
                            </div>
                        </div>
                        <!-- end php version -->

                        <!-- php modules -->
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label for="php-modules-php">PHP Modules</label>
                                <select id="php-modules-php" name="php[modules][]" multiple="multiple" class="form-control select-tags">
                                @foreach(Input::old('php.modules', $section->param('php_modules_available', [])) as $name)
                                <option value="{{ $name }}" {{ in_array($name, Input::old('php.modules', $section->param('php_modules', []))) ? 'selected="selected"' : '' }}>{{ $name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- end php modules -->

                        <!-- php ini -->
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label for="php-ini-displayer">INI Settings</label>
                                <select id="php-ini-displayer" multiple="multiple" class="form-control select-tags-user-input" data-target-container="php-ini" data-target-name="php[ini]">
                                @foreach($section->param('php_ini_available', []) as $name => $values)
                                @if(is_array($values))
                                <optgroup label="{{ $name }}">
                                    @foreach($values as $value)
                                    <option value="{{ $value }}" {{ in_array($value, array_keys(Input::old('php.ini', $section->param('php_ini', [])))) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </optgroup>
                                @else
                                    <option value="{{ $name }}" {{ in_array($name, array_keys(Input::old('php.ini', $section->param('php_ini', [])))) ? 'selected="selected"' : '' }}>{{ $name }}</option>
                                @endif
                                @endforeach
                                </select>

                                <div id="php-ini" style="display: none;">
                                    @foreach($section->param('php_ini', []) as $name => $value)
                                    <input type="hidden" name="php[ini][{{ $name }}]" data-option-name="{{ $name }}" value="{{ $value }}">
                                    @endforeach
                               </div>
                            </div>
                        </div>
                        <!-- end php ini -->

                        <!-- php timezone -->
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label for="php-timezone">PHP Timezone</label>
                                <select id="php-timezone" name="php[timezone]" class="form-control select-tag">
                                @foreach($section->param('php_timezone_available', []) as $name => $zones)
                                <optgroup label="{{ $name }}">
                                    @foreach($zones as $value)
                                    <option value="{{ $value }}" {{ Input::old('php.timezone', $section->param('php_timezone')) == $value ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- end php timezone -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end php settings -->

        <!-- pear settings -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PEAR</h3>
                    </div>

                    <div class="panel-body">
                        <!-- pear install -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="php-pear-install">
                                    <input type="checkbox" id="php-pear-install" name="php[pear][install]" {{ Input::old('php.pear.install', $section->param('pear_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install PEAR
                                </label>

                                <p class="help-block">
                                You can toggle this setting to turn on/off the PEAR installation.
                                </p>
                            </div>
                        </div>
                        <!-- end pear install -->

                        <!-- pear modules -->
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label for="php-pear-modules">PEAR Modules</label>
                                <select id="php-pear-modules" name="php[pear][modules][]" multiple="multiple" class="form-control select-tags selectized">
                                @foreach($section->param('pear_modules_available', []) as $name => $modules)
                                <optgroup label="{{ $name }}">
                                    @foreach($modules as $value)
                                    <option value="{{ $value }}" {{ in_array($value, Input::old('php.pear.modules', $section->param('pear_modules', []))) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- end pear modules -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end pear settings -->

        <!-- pear settings -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PECL</h3>
                    </div>

                    <div class="panel-body">
                        <!-- pecl install -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="php-pecl-install">
                                    <input type="checkbox" id="php-pecl-install" name="php[pecl][install]" {{ Input::old('php.pecl.install', $section->param('pecl_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install PECL
                                </label>

                                <p class="help-block">
                                You can toggle this setting to turn on/off the PECL installation.
                                </p>
                            </div>
                        </div>
                        <!-- end pecl install -->

                        <!-- pecl modules -->
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label for="php-pecl-modules">PECL Modules</label>
                                <select id="php-pecl-modules" name="php[pecl][modules][]" multiple="multiple" class="form-control select-tags selectized">
                                @foreach($section->param('pecl_modules_available', []) as $name => $modules)
                                <optgroup label="{{ $name }}">
                                    @foreach($modules as $value)
                                    <option value="{{ $value }}" {{ in_array($value, Input::old('php.pecl.modules', $section->param('pecl_modules', []))) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- end pecl modules -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end pear settings -->

        <!-- xdebug settings -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">XDebug</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row form-group">
                            <div class="col-xs-6">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="php[xdebug][install]" {{ Input::old('php.xdebug.install', $section->param('xdebug_install')) ? 'checked="checked"' : '' }} value="{{ $section->param('xdebug_install') }}"> Install XDebug
                                </label>

                                <p class="help-block">
                                    CLI debugging will automatically be available via <code>$ xdebug foo.php</code>. <a href="http://devincharge.com/debug-cli-remote-server/" target="_blank">Learn more about debugging a remote server</a>.
                                </p>
                            </div>

                            <div class="col-xs-6">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="php[xdebug][webgrind]" {{ Input::old('php.xdebug.webgrind', $section->param('xdebug_webgrind')) ? 'checked="checked"' : '' }} value="1"> Install Webgrind
                                </label>

                                <p class="help-block">
                                    Webgrind is a GUI for XDebug. <a href="https://github.com/jokkedk/webgrind" target="_blank">You can read more about it here.</a>
                                </p>
                            </div>

                            <div class="col-xs-12">
                                <label for="xdebug-settings-displayer">Settings</label>
                                <select id="xdebug-settings-displayer" multiple="multiple" class="form-control select-tags-user-input" data-target-container="xdebug-settings" data-target-name="php[xdebug][settings]">
                                @foreach($section->param('xdebug_settings_available', []) as $name => $value)
                                <option value="{{ $value }}" {{ in_array($value, array_keys(Input::old('php.xdebug.settings', $section->param('xdebug_settings', [])))) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                @endforeach
                                </select>

                                <div id="xdebug-settings" style="display: none;">
                                    @foreach(Input::old('php.xdebug.settings', $section->param('xdebug_settings', [])) as $name => $value)
                                    <input type="hidden" name="php[xdebug][settings][{{ $name }}]" data-option-name="{{ $name }}" value="{{ $value }}">
                                    @endforeach
                                </div>

                                <p class="help-block">
                                    <a href="https://jtreminio.com/2012/07/xdebug-and-you-why-you-should-be-using-a-real-debugger">Learn why you should be using a real debugger.</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end xdebug settings -->

        <!-- xhprof settings -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Xhprof</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="php[xhprof][install]" class="update-other-input" {{ Input::old('php.xhprof.install', $section->param('xhprof_install')) ? 'checked="checked"' : '' }} value="1" data-update-php[composer]="1"> Install Xhprof
                                </label>

                                <p class="help-block">
                                    Logs will be available from <a>http://&lt;ip_address&gt;/xhprof</a>.<br />
                                    The IP address is the <a href="#" data-tab-switch="sel-vagrant">one you chose here</a>.<br />
                                    <a href="http://www.geekyboy.com/archives/718#xhprof-usage" target="_blank">Learn how to use XHProf</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end xhprof settings -->

        <!-- extras settings -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Extras</h3>
                    </div>

                    <div class="panel-body">
                        <!-- phpmyadmin install -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="php-phpmyadmin-install">
                                    <input type="checkbox" id="php-phpmyadmin-install" name="php[phpmyadmin][install]" {{ Input::old('php.phpmyadmin.install', $section->param('phpmyadmin_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install phpMyAdmin
                                </label>

                                <p class="help-block">
                                    <a href="http://www.phpmyadmin.net/home_page/index.php" target="_blank">phpMyAdmin</a> will be available at <code>http://ipaddress/phpmyadmin</code>
                                </p>
                            </div>
                        </div>
                        <!-- end phpmyadmin install -->

                        <!-- composer install -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="php-composer-install">
                                    <input type="checkbox" id="php-composer-install" name="php[composer][install]" {{ Input::old('php.composer.install', $section->param('composer_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install Composer
                                </label>

                                <p class="help-block">
                                    <a href="https://getcomposer.org" target="_blank">Composer</a> will be available as a system service: <code>$ composer</code>
                                </p>
                            </div>
                        </div>
                        <!-- end composer install -->

                        <!-- mailcatcher install -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="php-mailcatcher-install">
                                    <input type="checkbox" id="php-mailcatcher-install" name="php[mailcatcher][install]" {{ Input::old('php.mailcatcher.install', $section->param('mailcatcher_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install Mailcatcher
                                </label>

                                <p class="help-block">
                                    <a href="http://mailcatcher.me/" target="_blank">Mailcatcher</a> will be available available at: <code>http://ipaddress:1080/</code>
                                </p>
                            </div>
                        </div>
                        <!-- end mailcatcher install -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end extras settings -->
        <!-- end php settings -->

    </div>
    <div class="tab-pane" id="section-languages-hhvm">

        <!-- hhvm settings -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">HHVM Settings</h3>
                    </div>

                    <div class="panel-body">
                        <!-- hhvm install -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="hhvm-install">
                                    <input type="checkbox" id="hhvm-install" name="hhvm[install]" {{ Input::old('hhvm.install', $section->param('hhvm_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install
                                </label>

                                <p class="help-block">
                                You can toggle this setting to turn on/off the HHVM installation.
                                </p>
                            </div>
                        </div>
                        <!-- end hhvm install -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end hhvm settings -->

    </div>
</div>
