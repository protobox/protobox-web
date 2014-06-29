<div class="row" id="nginx-vhosts-{{ $vhostid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Nginx Virtual Host #{{ $type != 'template' ? (int) $vhostid + 1 : '{vhostnewid}' }}</h3>
            </div>

            <div class="panel-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-name">Vhost Name</label>
                        <input type="text" id="nginx-vhosts-{{ $vhostid }}-name" name="nginx[vhosts][{{ $vhostid }}][name]" placeholder="{{ $type == 'template' ? $section->param('nginx_virtualhost_name') : (isset($vhost['name']) ? $vhost['name'] : '') }}" value="{{ $type == 'template' ? $section->param('nginx_virtualhost_name') : (isset($vhost['name']) ? $vhost['name'] : '') }}" class="form-control">

                        <p class="help-block">The name of this vhost configuration.</p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-servername">Server Name</label>
                        <input type="text" id="nginx-vhosts-{{ $vhostid }}-servername" name="nginx[vhosts][{{ $vhostid }}][servername]" placeholder="{{ $type == 'template' ? $section->param('nginx_virtualhost_servername') : (isset($vhost['servername']) ? $vhost['servername'] : '') }}" value="{{ $type == 'template' ? $section->param('nginx_virtualhost_servername') : (isset($vhost['servername']) ? $vhost['servername'] : '') }}" class="form-control">

                        <p class="help-block">The URL you want to use to access this site on your computer. <a href="http://getprotobox.com/docs/issues/hosts" target="_blank">Don't forget to add this to your <code>hosts</code> file!</a></p>
                    </div>

                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-serveraliases">Server Aliases</label>
                        <select id="nginx-vhosts-{{ $vhostid }}-serveraliases" name="nginx[vhosts][{{ $vhostid }}][serveraliases][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type == 'template')
                            @foreach($section->param('nginx_virtualhost_serveraliases') as $alias)
                            <option value="{{ $alias }}" selected="selected">{{ $alias }}</option>
                            @endforeach
                        @elseif(isset($vhost['serveraliases']))
                            @foreach($vhost['serveraliases'] as $alias)
                            <option value="{{ $alias }}" selected="selected">{{ $alias }}</option>
                            @endforeach
                        @endif
                        </select>

                        <p class="help-block">Server aliases are secondary ways to access this site on your computer. Typically <code>www.{{ $vhost['servername'] }}</code> or any other subdomains you want to have.</p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-docroot">Document Root</label>
                        <input type="text" id="nginx-vhosts-{{ $vhostid }}-docroot" name="nginx[vhosts][{{ $vhostid }}][docroot]" placeholder="{{ $type == 'template' ? $section->param('nginx_virtualhost_docroot') : (isset($vhost['docroot']) ? $vhost['docroot'] : '') }}" value="{{ $type == 'template' ? $section->param('nginx_virtualhost_docroot') : (isset($vhost['docroot']) ? $vhost['docroot'] : '') }}" class="form-control">

                        <p class="help-block">The location of your site's index file, or other landing page on the file system.</p>
                    </div>

                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-port">Port</label>
                        <input type="text" id="nginx-vhosts-{{ $vhostid }}-port" name="nginx[vhosts][{{ $vhostid }}][port]" placeholder="{{ $type == 'template' ? $section->param('nginx_virtualhost_port') : (isset($vhost['port']) ? $vhost['port'] : '') }}" value="{{ $type == 'template' ? $section->param('nginx_virtualhost_port') : (isset($vhost['port']) ? $vhost['port'] : '') }}" class="form-control">

                        <p class="help-block">
                            80 for normal browsing, if you choose another append it to the URL, ex: http://{{ $vhost['servername'] }}:1337
                        </p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-setenv">Environment Variables</label>
                        <select id="nginx-vhosts-{{ $vhostid }}-setenv" name="nginx[vhosts][{{ $vhostid }}][setenv][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type == 'template')
                            @foreach($section->param('nginx_virtualhost_setenv') as $env)
                            <option value="{{ $env }}" selected="selected">{{ $env }}</option>
                            @endforeach
                        @elseif(isset($vhost['setenv']))
                            @foreach($vhost['setenv'] as $env)
                            <option value="{{ $env }}" selected="selected">{{ $env }}</option>
                            @endforeach
                        @endif
                        </select>

                        <p class="help-block">These should be "name value" list of environmental variables you want to access in your code.</p>
                    </div>

                    <div class="col-md-6">
                        &nbsp;
                    </div>
                </div>

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#nginx-vhosts-{{ $vhostid }}" data-template-id="{{ $vhostid }}">Remove this vhost</button>
                </p>
            </div>
        </div>
    </div>
</div>
