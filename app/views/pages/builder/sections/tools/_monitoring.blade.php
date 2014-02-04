<!-- newrelic settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">NewRelic</h3>
            </div>

            <div class="panel-body">
                <!-- install -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="newrelic-install">
                            <input type="checkbox" id="newrelic-install" name="newrelic[install]" {{ Input::old('newrelic.install', $section->param('newrelic_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the <a href="http://newrelic.com" target="_blank">NewRelic</a> installation.
                        </p>
                    </div>
                </div>
                <!-- end install -->

                <!-- license -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="newrelic-license">License Key</label>
                        <input type="text" id="newrelic-license" name="newrelic[license]" value="{{ Input::old('newrelic.license', $section->param('newrelic_license')) }}" class="form-control">

                        <p class="help-block">
                            Insert your newrelic license key here.
                        </p>
                    </div>
                </div>
                <!-- end license -->

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="newrelic-php">
                            <input type="checkbox" id="newrelic-php" name="newrelic[php]" {{ Input::old('newrelic.php', $section->param('newrelic_php')) ? 'checked="checked"' : '' }} value="1">
                            Install PHP Agent
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the NewRelic <a href="http://newrelic.com/php" target="_blank">PHP Agent</a>.
                        </p>
                    </div>

                    <div class="col-md-6">
                        <label for="newrelic-node">
                            <input type="checkbox" id="newrelic-node" name="newrelic[node]" {{ Input::old('newrelic.node', $section->param('newrelic_node')) ? 'checked="checked"' : '' }} value="1">
                            Install Node Agent
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the NewRelic <a href="http://newrelic.com/nodejs" target="_blank">Node Agent</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end new relic settings -->
