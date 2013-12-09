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
                                    @foreach($section->param('apache_modules', []) as $mod)
                                    <option selected value="{{ $mod }}">{{ $mod }}</option>
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
        <div class="row" id="apache-vhosts-{{ $vhostid }}">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Apache Virtual Host</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="apache-vhosts-{{ $vhostid }}-servername">Server Name</label>
                                <input type="text" id="apache-vhosts-{{ $vhostid }}-servername" name="webserver[apache][vhosts][{{ $vhostid }}][servername]" placeholder="{{ $vhost['server_name'] }}" value="{{ $vhost['server_name'] }}" class="form-control">

                                <p class="help-block">Don't forget to add to your computer's hosts file!</p>
                            </div>

                            <div class="col-md-6">
                                <label for="apache-vhosts-{{ $vhostid }}-serveraliases">Server Aliases</label>
                                <select id="apache-vhosts-{{ $vhostid }}-serveraliases" name="webserver[apache][vhosts][{{ $vhostid }}][serveraliases][]" multiple="multiple" class="form-control select-tags-editable">
                                    @foreach($vhost['server_alias'] as $alias)
                                    <option value="{{ $alias }}" selected="selected"></option>
                                    @endforeach
                                </select>

                                <p class="help-block">Separated by comma</p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="apache-vhosts-{{ $vhostid }}-docroot">Document Root</label>
                                <input type="text" id="apache-vhosts-{{ $vhostid }}-docroot" name="webserver[apache][vhosts][{{ $vhostid }}][docroot]" placeholder="{{ $vhost['document_root'] }}" value="{{ $vhost['document_root'] }}" class="form-control">

                                <p class="help-block">Location of your site's index.php file, or other landing page.</p>
                            </div>

                            <div class="col-md-6">
                                <label for="apache-vhosts-{{ $vhostid }}-port">Port</label>
                                <input type="text" id="apache-vhosts-{{ $vhostid }}-port" name="webserver[apache][vhosts][{{ $vhostid }}][port]" placeholder="{{ $vhost['port'] }}" value="{{ $vhost['port'] }}" class="form-control">

                                <p class="help-block">
                                    80 for normal browsing, if you choose another append it to the URL,
                                    ex: http://{{ $vhost['server_name'] }}:1337
                                </p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="apache-vhosts-{{ $vhostid }}-setenv">Environment Variables</label>
                                <select id="apache-vhosts-{{ $vhostid }}-setenv" name="webserver[apache][vhosts][{{ $vhostid }}][setenv][]" multiple="multiple" class="form-control select-tags-editable">
                                @foreach($vhost['environment'] as $env)
                                <option value="{{ $env }}" selected="selected"></option>
                                @endforeach
                                </select>

                                <p class="help-block">"name value", separated by comma</p>
                            </div>

                            <div class="col-md-6">
                                <label for="apache-vhosts-{{ $vhostid }}-override">AllowOverride</label>
                                <select id="apache-vhosts-{{ $vhostid }}-override" name="webserver[apache][vhosts][{{ $vhostid }}][override][]" multiple="multiple" class="form-control select-tags-editable">
                                @foreach($vhost['override'] as $ovr)
                                <option value="{{ $ovr }}" selected="selected"></option>
                                @endforeach
                                </select>

                                <p class="help-block">
                                    Separated by comma, "All" is probably fine.
                                    <a href="http://httpd.apache.org/docs/2.2/mod/core.html#allowoverride" target="_blank">Click here for more hardcore information.</a>
                                </p>
                            </div>
                        </div>

                        <p class="text-center">
                            <button type="button" class="btn btn-danger btn-sm deleteParentContainer" data-parent-id="{{ $vhostid }}">Remove this vhost</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end apache / vhost -->
        @endforeach
        
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-push-2">
                <button type="button" class="btn btn-success btn-lg btn-block addParentContainer" data-source-url="/extensions/apache/vhost">Add another Apache vhost</button>
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
        <div class="row" id="nginx-vhosts-{{ $vhostid }}">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nginx Virtual Host</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="nginx-vhosts-{{ $vhostid }}-servername">Server Name</label>
                                <input type="text" id="nginx-vhosts-{{ $vhostid }}-servername" name="webserver[nginx][vhosts][{{ $vhostid }}][servername]" placeholder="{{ $vhost['server_name'] }}" value="{{ $vhost['server_name'] }}" class="form-control">

                                <p class="help-block">Don't forget to add to your computer's hosts file!</p>
                            </div>

                            <div class="col-md-6">
                                <label for="nginx-vhosts-{{ $vhostid }}-serveraliases">Server Aliases</label>
                                <select id="nginx-vhosts-{{ $vhostid }}-serveraliases" name="webserver[nginx][vhosts][{{ $vhostid }}][serveraliases][]" multiple="multiple" class="form-control select-tags-editable">
                                    @foreach($vhost['server_alias'] as $alias)
                                    <option value="{{ $alias }}" selected="selected"></option>
                                    @endforeach
                                </select>

                                <p class="help-block">Separated by comma</p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="nginx-vhosts-{{ $vhostid }}-docroot">Document Root</label>
                                <input type="text" id="nginx-vhosts-{{ $vhostid }}-docroot" name="webserver[nginx][vhosts][{{ $vhostid }}][docroot]" placeholder="{{ $vhost['document_root'] }}" value="{{ $vhost['document_root'] }}" class="form-control">

                                <p class="help-block">Location of your site's index.php file, or other landing page.</p>
                            </div>

                            <div class="col-md-6">
                                <label for="nginx-vhosts-{{ $vhostid }}-port">Port</label>
                                <input type="text" id="nginx-vhosts-{{ $vhostid }}-port" name="webserver[nginx][vhosts][{{ $vhostid }}][port]" placeholder="{{ $vhost['port'] }}" value="{{ $vhost['port'] }}" class="form-control">

                                <p class="help-block">
                                    80 for normal browsing, if you choose another append it to the URL,
                                    ex: http://{{ $vhost['server_name'] }}:1337
                                </p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="nginx-vhosts-{{ $vhostid }}-setenv">Environment Variables</label>
                                <select id="nginx-vhosts-{{ $vhostid }}-setenv" name="webserver[nginx][vhosts][{{ $vhostid }}][setenv][]" multiple="multiple" class="form-control select-tags-editable">
                                @foreach($vhost['environment'] as $env)
                                <option value="{{ $env }}" selected="selected"></option>
                                @endforeach
                                </select>

                                <p class="help-block">"name value", separated by comma</p>
                            </div>

                            <div class="col-md-6">
                                &nbsp;
                            </div>
                        </div>

                        <p class="text-center">
                            <button type="button" class="btn btn-danger btn-sm deleteParentContainer" data-parent-id="{{ $vhostid }}">Remove this vhost</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end apache / vhost -->
        @endforeach
        
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-push-2">
                <button type="button" class="btn btn-success btn-lg btn-block addParentContainer" data-source-url="/extensions/apache/vhost">Add another Nginx vhost</button>
            </div>
        </div>

    </div>
</div>