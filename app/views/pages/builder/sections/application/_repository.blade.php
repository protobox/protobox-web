<div class="row" id="application-repository-{{ $appid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Repository</h3>
            </div>

            <div class="panel-body">
                <!-- install / name -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-repository-{{ $appid }}-name">Name</label>
                        <input type="text" id="application-repository-{{ $appid }}-name" name="applications[repository][{{ $appid }}][name]" placeholder="{{ $type == 'template' ? $section->param('repository_name') : $vhost['name'] }}" value="{{ $type == 'template' ? $section->param('repository_name') : $vhost['name'] }}" class="form-control">

                        <p class="help-block">
                        The name of this application for your own reference.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-repository-{{ $appid }}-install">
                            <input type="checkbox" id="application-repository-{{ $appid }}-install" name="applications[repository][{{ $appid }}][install]" {{ $type == 'template' ? ($section->param('repository_install') ? 'checked="checked"' : '') : ($vhost['install'] ? 'checked="checked"' : '') }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off this repository installation.
                        </p>
                    </div>
                </div>
                <!-- end install / name -->

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="application-repository-{{ $appid }}-path">Document Root</label>
                        <input type="text" id="application-repository-{{ $appid }}-path" name="applications[repository][{{ $appid }}][path]" placeholder="{{ $type == 'template' ? $section->param('repository_path') : $vhost['path'] }}" value="{{ $type == 'template' ? $section->param('repository_path') : $vhost['path'] }}" class="form-control">

                        <p class="help-block">Location of your site's index.php file, or other landing page. This should match the <code>document root</code> from <a href="#section-webserver"  data-toggle="tab">apache or nginx</a> settings.</p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-repository-{{ $appid }}-source">Git Repository</label>
                        <input type="text" id="application-repository-{{ $appid }}-source" name="applications[repository][{{ $appid }}][source]" placeholder="{{ $type == 'template' ? $section->param('repository_source') : $vhost['source'] }}" value="{{ $type == 'template' ? $section->param('repository_source') : $vhost['source'] }}" class="form-control">

                        <p class="help-block">Insert the GIT repository URL here.</p>
                    </div>
                    <div class="col-md-6">
                        <label for="application-repository-{{ $appid }}-revision">Git Branch / Tag</label>
                        <input type="text" id="application-repository-{{ $appid }}-revision" name="applications[repository][{{ $appid }}][revision]" placeholder="{{ $type == 'template' ? $section->param('repository_revision') : $vhost['revision'] }}" value="{{ $type == 'template' ? $section->param('repository_revision') : $vhost['revision'] }}" class="form-control">

                        <p class="help-block">Insert the git branch or tag name here. Defaults to <code>master</code> branch.</p>
                    </div>
                </div>

                <!-- pre install -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="application-repository-{{ $appid }}-preinstall">Pre Install Commands</label>
                        <select id="application-repository-{{ $appid }}-preinstall" name="applications[repository][{{ $appid }}][preinstall][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type == 'template')
                        	@foreach($section->param('repository_pre_install') as $cmd)
                            <option value="{{ $cmd }}" selected="selected">{{ $cmd }}</option>
                            @endforeach
                        @else
                            @foreach($vhost['preinstall'] as $cmd)
                            <option value="{{ $cmd }}" selected="selected">{{ $cmd }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="application-repository-{{ $appid }}-postinstall">Post Install Commands</label>
                        <select id="application-repository-{{ $appid }}-postinstall" name="applications[repository][{{ $appid }}][postinstall][]" multiple="multiple" class="form-control select-tags-editable">
                        @if($type == 'template')
                        	@foreach($section->param('repository_post_install') as $cmd)
                            <option value="{{ $cmd }}" selected="selected">{{ $cmd }}</option>
                            @endforeach
                        @else
                            @foreach($vhost['postinstall'] as $cmd)
                            <option value="{{ $cmd }}" selected="selected">{{ $cmd }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                </div>
                <!-- end post install -->

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#application-repository-{{ $appid }}" data-template-id="{{ $appid }}">Remove this application</button>
                </p>
            </div>

        </div>
    </div>
</div>