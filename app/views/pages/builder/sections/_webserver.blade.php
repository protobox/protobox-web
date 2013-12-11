<input type="hidden" name="webserver[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$name.'.name') }}</h1>
</div>

@if (count($section->webservers()))
<ul class="nav nav-pills nav-section">
    @foreach($section->webservers() as $type => $name)
    <li class="{{ $type == 'apache' ? 'active' : '' }}"><a href="#section-webserver-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    <!-- apache -->
    <div class="tab-pane active" id="section-webserver-apache">

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
                                    <input type="checkbox" id="apache-install" name="webserver[apache][install]" {{ $section->param('apache_install') ? 'checked="checked"' : '' }} value="{{ $section->param('apache_install') }}">
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
                                <select id="apache-modules" name="webserver[apache][modules][]" multiple="multiple" class="form-control select-tags-editable">
                                    @foreach($section->param('apache_modules_available', []) as $name => $value)
                                    <option value="php5-{{ $value }}" {{ in_array($value, Input::old('webserver.apache.modules', $section->param('apache_modules', []))) ? 'selected="selected"' : '' }}>{{ $value }}</option>
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

        @foreach($section->param('apache_virtualhosts', []) as $vhostid => $vhost)
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
                <button type="button" class="btn btn-success btn-lg btn-block" data-template="#apache-vhosts-template" data-id-start="{{ count($section->param('apache_virtualhosts', [])) }}" data-replace="vhostid:[id]" data-append=".row">Add another Apache vhost</button>
            </div>
        </div>

    </div>

    <!-- nginx -->
    <div class="tab-pane" id="section-webserver-nginx">

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
                                    <input type="checkbox" id="nginx-install" name="webserver[nginx][install]" {{ $section->param('nginx_install') ? 'checked="checked"' : '' }} value="{{ $section->param('nginx_install') }}">
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

        @foreach($section->param('nginx_virtualhosts', []) as $vhostid => $vhost)
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
                <button type="button" class="btn btn-success btn-lg btn-block" data-template="#nginx-vhosts-template" data-id-start="{{ count($section->param('nginx_virtualhosts', [])) }}" data-replace="vhostid:[id]" data-append=".row">Add another Nginx vhost</button>
            </div>
        </div>

    </div>
</div>