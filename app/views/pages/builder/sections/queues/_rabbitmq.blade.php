<input type="hidden" name="rabbitmq[_prevent_empty]" />

<!-- rabbitmq settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">RabbitMQ</h3>
            </div>

            <div class="panel-body">
                <!-- install -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="rabbitmq-install">
                            <input type="checkbox" id="rabbitmq-install" name="rabbitmq[install]" {{ Input::old('rabbitmq.install', $section->param('rabbitmq_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the <a href="http://www.rabbitmq.com/" target="_blank">RabbitMQ</a> installation.
                        </p>
                    </div>
                </div>
                <!-- end install -->
            </div>
        </div>
    </div>
</div>
<!-- rabbitmq settings -->