<div class="row" id="apache-vhosts-{{ $vhostid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Apache Virtual Host #{{ $type != 'template' ? (int) $vhostid + 1 : '{vhostnewid}' }}</h3>
            </div>

            <div class="panel-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-servername">Server Name</label>
                        <input type="text" id="apache-vhosts-{{ $vhostid }}-servername" name="apache[vhosts][{{ $vhostid }}][servername]" placeholder="{{ $type == 'template' ? '' : (isset($vhost['servername']) ? $vhost['servername'] : '') }}" value="{{ $type == 'template' ? '' : (isset($vhost['servername']) ? $vhost['servername'] : '') }}" class="form-control">

                        <p class="help-block">The URL you want to use to access this site on your computer. Don't forget to add this to your <code>hosts</code> file!</p>
                    </div>

                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-serveraliases">Server Aliases</label>
                        <select id="apache-vhosts-{{ $vhostid }}-serveraliases" name="apache[vhosts][{{ $vhostid }}][serveraliases][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type != 'template' && isset($vhost['serveraliases']))
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
                        <label for="apache-vhosts-{{ $vhostid }}-docroot">Document Root</label>
                        <input type="text" id="apache-vhosts-{{ $vhostid }}-docroot" name="apache[vhosts][{{ $vhostid }}][docroot]" placeholder="{{ $type == 'template' ? '' : (isset($vhost['docroot']) ? $vhost['docroot'] : '') }}" value="{{ $type == 'template' ? '' : (isset($vhost['docroot']) ? $vhost['docroot'] : '') }}" class="form-control">

                        <p class="help-block">The location of your site's index file, or other landing page on the file system.</p>
                    </div>

                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-port">Port</label>
                        <input type="text" id="apache-vhosts-{{ $vhostid }}-port" name="apache[vhosts][{{ $vhostid }}][port]" placeholder="{{ $type == 'template' ? '' : (isset($vhost['port']) ? $vhost['port'] : '') }}" value="{{ $type == 'template' ? '' : (isset($vhost['port']) ? $vhost['port'] : '') }}" class="form-control">

                        <p class="help-block">
                            80 for normal browsing, if you choose another append it to the URL, ex: http://{{ $vhost['servername'] }}:1337
                        </p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-setenv">Environment Variables</label>
                        <select id="apache-vhosts-{{ $vhostid }}-setenv" name="apache[vhosts][{{ $vhostid }}][setenv][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type != 'template' && isset($vhost['setenv']))
                            @foreach($vhost['setenv'] as $env)
                            <option value="{{ $env }}" selected="selected">{{ $env }}</option>
                            @endforeach
                        @endif
                        </select>

                        <p class="help-block">These should be "name value" list of environmental variables you want to access in your code.</p>
                    </div>

                    <div class="col-md-6">
                        <label for="apache-vhosts-{{ $vhostid }}-override">Allow Override</label>
                        <select id="apache-vhosts-{{ $vhostid }}-override" name="apache[vhosts][{{ $vhostid }}][override][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type != 'template' && isset($vhost['override']))
                            @foreach($vhost['override'] as $ovr)
                            <option value="{{ $ovr }}" selected="selected">{{ $ovr }}</option>
                            @endforeach
                        @endif
                        </select>

                        <p class="help-block">
                            "All" is suitable for most installations. 
                            <a href="http://httpd.apache.org/docs/2.2/mod/core.html#allowoverride" target="_blank">Click here for technical information.</a>
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