<input type="hidden" name="nginx[_prevent_empty]" />

<!-- nginx settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Nginx Settings</h3>
            </div>

            <div class="panel-body">
                <!-- nginx install -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="nginx-install">
                            <input type="checkbox" id="nginx-install" name="nginx[install]" {{ Input::old('nginx.install', $section->param('nginx_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the nginx installation.
                        </p>
                    </div>
                </div>
                <!-- end nginx install -->
            </div>

        </div>
    </div>
</div>
<!-- end nginx settings -->

@foreach(Input::old('nginx.vhosts', $section->param('nginx_virtualhosts', [])) as $vhostid => $vhost)
<!-- nginx / vhost -->
@include('pages.builder.sections.webserver._nginx_virtualhost', ['type' => 'data'])
<!-- end nginx / vhost -->
@endforeach

<script type="text/template" id="nginx-vhosts-template">
<!-- nginx / vhost -->
@include('pages.builder.sections.webserver._nginx_virtualhost', ['type' => 'template', 'vhostid' => '{vhostid}'])
<!-- end nginx / vhost -->
</script>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-push-2">
        <button type="button" class="btn btn-success btn-lg btn-block" data-template="#nginx-vhosts-template" data-id-start="{{ count(Input::old('nginx.vhosts', $section->param('nginx_virtualhosts', []))) }}" data-replace="vhostid:[id],vhostnewid:[newid]" data-append=".row">Add another Nginx vhost</button>
    </div>
</div>