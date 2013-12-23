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
                        <input type="text" id="apache-vhosts-{{ $vhostid }}-servername" name="webserver[apache][vhosts][{{ $vhostid }}][servername]" placeholder="{{ $type == 'template' ? '' : $vhost['servername'] }}" value="{{ $type == 'template' ? '' : $vhost['servername'] }}" class="form-control">

                        <p class="help-block">Don't forget to add to your computer's hosts file!</p>
                    </div>

                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-serveraliases">Server Aliases</label>
                        <select id="apache-vhosts-{{ $vhostid }}-serveraliases" name="webserver[apache][vhosts][{{ $vhostid }}][serveraliases][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type != 'template')
                            @foreach($vhost['serveraliases'] as $alias)
                            <option value="{{ $alias }}" selected="selected">{{ $alias }}</option>
                            @endforeach
                        @endif
                        </select>

                        <p class="help-block">Separated by comma</p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-docroot">Document Root</label>
                        <input type="text" id="apache-vhosts-{{ $vhostid }}-docroot" name="webserver[apache][vhosts][{{ $vhostid }}][docroot]" placeholder="{{ $type == 'template' ? '' : $vhost['docroot'] }}" value="{{ $type == 'template' ? '' : $vhost['docroot'] }}" class="form-control">

                        <p class="help-block">Location of your site's index.php file, or other landing page.</p>
                    </div>

                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-port">Port</label>
                        <input type="text" id="apache-vhosts-{{ $vhostid }}-port" name="webserver[apache][vhosts][{{ $vhostid }}][port]" placeholder="{{ $type == 'template' ? '' : $vhost['port'] }}" value="{{ $type == 'template' ? '' : $vhost['port'] }}" class="form-control">

                        <p class="help-block">
                            80 for normal browsing, if you choose another append it to the URL,
                            ex: http://{{ $vhost['servername'] }}:1337
                        </p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-setenv">Environment Variables</label>
                        <select id="apache-vhosts-{{ $vhostid }}-setenv" name="webserver[apache][vhosts][{{ $vhostid }}][setenv][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type != 'template')
                            @foreach($vhost['setenv'] as $env)
                            <option value="{{ $env }}" selected="selected">{{ $env }}</option>
                            @endforeach
                        @endif
                        </select>

                        <p class="help-block">"name value", separated by comma</p>
                    </div>

                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-override">AllowOverride</label>
                        <select id="apache-vhosts-{{ $vhostid }}-override" name="webserver[apache][vhosts][{{ $vhostid }}][override][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type != 'template')
                            @foreach($vhost['override'] as $ovr)
                            <option value="{{ $ovr }}" selected="selected">{{ $ovr }}</option>
                            @endforeach
                        @endif
                        </select>

                        <p class="help-block">
                            Separated by comma, "All" is probably fine.
                            <a href="http://httpd.apache.org/docs/2.2/mod/core.html#allowoverride" target="_blank">Click here for more hardcore information.</a>
                        </p>
                    </div>
                </div>

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#apache-vhosts-{{ $vhostid }}" data-template-id="{{ $vhostid }}">Remove this vhost</button>
                </p>
            </div>
        </div>
    </div>
</div>