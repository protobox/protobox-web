<input type="hidden" name="apache[_prevent_empty]" />

<!-- apache settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Apache Settings</h3>
            </div>

            <div class="panel-body">
                <!-- apache install -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="apache-install">
                            <input type="checkbox" id="apache-install" name="apache[install]" {{ Input::old('apache.install', $section->param('apache_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the apache installation.
                        </p>
                    </div>
                </div>
                <!-- end apache install -->

                <!-- apache modules -->
                <div class="row form-group">
                    <div class="col-xs-12">
                        <label for="apache-modules">Apache Modules</label>
                        <select id="apache-modules" name="apache[modules][]" multiple="multiple" class="form-control select-tags-editable">
                            @foreach(Input::old('apache.modules', $section->param('apache_modules_available', [])) as $name => $value)
                            <option value="{{ $value }}" {{ in_array($value, Input::old('apache.modules', $section->param('apache_modules', []))) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end apache modules -->
            </div>

        </div>
    </div>
</div>
<!-- end apache settings -->

@foreach(Input::old('apache.vhosts', $section->param('apache_virtualhosts', [])) as $vhostid => $vhost)
<!-- apache / vhost -->
@include('pages.builder.sections.webserver._apache_virtualhost', ['type' => 'data'])
<!-- end apache / vhost -->
@endforeach

<script type="text/template" id="apache-vhosts-template">
<!-- apache / vhost -->
@include('pages.builder.sections.webserver._apache_virtualhost', ['type' => 'template', 'vhostid' => '{vhostid}'])
<!-- end apache / vhost -->
</script>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-push-2">
        <button type="button" class="btn btn-success btn-lg btn-block" data-template="#apache-vhosts-template" data-id-start="{{ count(Input::old('apache.vhosts', $section->param('apache_virtualhosts', []))) }}" data-replace="vhostid:[id],vhostnewid:[newid]" data-append=".row">Add another Apache vhost</button>
    </div>
</div>