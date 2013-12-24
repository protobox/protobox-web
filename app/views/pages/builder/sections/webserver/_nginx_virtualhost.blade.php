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
                        <input type="text" id="nginx-vhosts-{{ $vhostid }}-servername" name="webserver[nginx][vhosts][{{ $vhostid }}][servername]" placeholder="{{ $type == 'template' ? '' : $vhost['servername'] }}" value="{{ $type == 'template' ? '' : $vhost['servername'] }}" class="form-control">

                        <p class="help-block">Don't forget to add to your computer's hosts file!</p>
                    </div>

                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-serveraliases">Server Aliases</label>
                        <select id="nginx-vhosts-{{ $vhostid }}-serveraliases" name="webserver[nginx][vhosts][{{ $vhostid }}][serveraliases][]" multiple="multiple" class="form-control select-tags-editable">
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
                        <label for="nginx-vhosts-{{ $vhostid }}-docroot">Document Root</label>
                        <input type="text" id="nginx-vhosts-{{ $vhostid }}-docroot" name="webserver[nginx][vhosts][{{ $vhostid }}][docroot]" placeholder="{{ $type == 'template' ? '' : $vhost['docroot'] }}" value="{{ $type == 'template' ? '' : $vhost['docroot'] }}" class="form-control">

                        <p class="help-block">Location of your site's index.php file, or other landing page.</p>
                    </div>

                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-port">Port</label>
                        <input type="text" id="nginx-vhosts-{{ $vhostid }}-port" name="webserver[nginx][vhosts][{{ $vhostid }}][port]" placeholder="{{ $type == 'template' ? '' : $vhost['port'] }}" value="{{ $type == 'template' ? '' : $vhost['port'] }}" class="form-control">

                        <p class="help-block">
                            80 for normal browsing, if you choose another append it to the URL,
                            ex: http://{{ $vhost['servername'] }}:1337
                        </p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="nginx-vhosts-{{ $vhostid }}-setenv">Environment Variables</label>
                        <select id="nginx-vhosts-{{ $vhostid }}-setenv" name="webserver[nginx][vhosts][{{ $vhostid }}][setenv][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type != 'template')
                            @foreach($vhost['setenv'] as $env)
                            <option value="{{ $env }}" selected="selected">{{ $env }}</option>
                            @endforeach
                        @endif
                        </select>

                        <p class="help-block">"name value", separated by comma</p>
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
