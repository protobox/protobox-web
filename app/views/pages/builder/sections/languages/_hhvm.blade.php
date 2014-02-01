<input type="hidden" name="hhvm[_prevent_empty]" />

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
                    <div class="col-md-6">
                        <label for="hhvm-install">
                            <input type="checkbox" id="hhvm-install" name="hhvm[install]" {{ Input::old('hhvm.install', $section->param('hhvm_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the HHVM installation.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="hhvm-nightly">
                            <input type="checkbox" id="hhvm-nightly" name="hhvm[nightly]" {{ Input::old('hhvm.nightly', $section->param('hhvm_nightly')) ? 'checked="checked"' : '' }} value="1">
                            Use HHVM Nightlies
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the <a href="http://www.hhvm.com/blog/3203/nightly-packages" target="_blank">HHVM Nightly Package</a> installation.
                        </p>
                    </div>
                </div>
                <!-- end hhvm install -->
            </div>
        </div>
    </div>
</div>
<!-- end hhvm settings -->

<!-- extras settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Extras</h3>
            </div>

            <div class="panel-body">
                <!-- composer install -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="hhvm-composer-install">
                            <input type="checkbox" id="hhvm-composer-install" name="hhvm[composer][install]" {{ Input::old('hhvm.composer.install', $section->param('hhvm_composer_install')) ? 'checked="checked"' : '' }} value="1">
                            Install Composer
                        </label>

                        <p class="help-block">
                            <a href="https://getcomposer.org" target="_blank">Composer</a> will be available as a system service: <code>$ composer</code>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="hhvm-composer-use_hhvm">
                            <input type="checkbox" id="hhvm-composer-use_hhvm" name="hhvm[composer][use_hhvm]" {{ Input::old('hhvm.composer.use_hhvm', $section->param('hhvm_composer_use_hhvm')) ? 'checked="checked"' : '' }} value="1">
                            Use HHVM for Composer
                        </label>

                        <p class="help-block">
                            This will use HHVM to process composer, greatly increasing speed.
                        </p>
                    </div>
                </div>
                <!-- end composer install -->
            </div>
        </div>
    </div>
</div>
<!-- end extras settings -->