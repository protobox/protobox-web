<input type="hidden" name="server[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$name.'.name') }}</h1>
</div>

<!-- server packages -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Server Packages</h3>
            </div>

            <div class="panel-body">
                <div class="row form-group">
                    <div class="col-xs-12">
                        <label for="server-packages">Installed Packages</label>
                        <select id="server-packages" name="server[packages][]" multiple="multiple" class="form-control select-tags-editable">
                            @foreach(Input::old('server.packages', $section->param('packages', [])) as $package)
                            <option selected value="{{ $package }}">{{ $package }}</option>
                            @endforeach
                        </select>

                        <p class="help-block">
                            Packages to install via the OS package manager. Do not install any web servers, databases, or languages here since you will configure them in later steps. <code>curl</code> and <code>git</code> are automatically installed.
                        </p>
                        <div class="row">
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                Debian / Ubuntu:
                                <ul>
                                    <li><a href="#" class="add-input" data-target="server-packages" data-value="vim">vim</a></li>
                                </ul>
                            </div>
                            {{-- 
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                CentOS:
                                <ul>
                                    <li><a href="#" class="add-input" data-target="server-packages" data-value="vim-common">vim-common</a></li>
                                </ul>
                            </div>
                            --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end server packages -->

<!-- ssh keys -->
{{-- 
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">SSH Keys</h3>
            </div>

            <div class="panel-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="vagrant-local-name">Authorized Keys</label>
                        @foreach($section->param('ssh_authorized_keys', []) as $ssh)
                        <input type="text" name="server[ssh][authorized_keys][]" placeholder="" value="{{ $ssh }}" class="form-control">
                        @endforeach
                        <input type="text" name="server[ssh][authorized_keys][]" placeholder="" value="{{ $ssh }}" class="form-control">

                        <p class="help-block">
                        You can add a git repository of dotfiles here to be copied into the VM. Make sure you also setup SSH keys to access the GIT repository. 
                        </p>
                    </div>
                </div>

                <p>AND / OR</p>

                <p>
                    You can also add all your ssh keys and config files (<code>id_rsa</code>, <code>config</code>, etc),
                    to the <code>./data/ssh/</code> folder. During initial startup they will automatically be copied to the VM.
                </p>
            </div>

        </div>
    </div>
</div>
--}}
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">SSH Keys</h3>
            </div>

            <div class="panel-body">
                <p>
                    You can also add all your ssh keys and config files (<code>id_rsa</code>, <code>config</code>, etc), to the <code>./data/ssh/</code> folder. During initial startup they will automatically be copied to the VM.
                </p>
            </div>

        </div>
    </div>
</div>
<!-- end ssh keys -->

<!-- dotfiles -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dotfiles</h3>
            </div>

            <div class="panel-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="server-dotfiles-install">
                            <input type="checkbox" id="server-dotfiles-install" name="server[dotfiles][install]" {{ Input::old('server.dotfiles.install', $section->param('dotfiles_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to globally turn on/off the dotfiles installation.
                        </p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="vagrant-local-name">Dotfiles Repository</label>
                        <input type="text" name="server[dotfiles][repo]" placeholder="{{ $section->param('dotfiles_repo') }}" value="{{ Input::old('server.dotfiles.repo', $section->param('dotfiles_repo')) }}" class="form-control">

                        <p class="help-block">
                        You can add a git repository of dotfiles here to be copied into the VM. Make sure you also setup SSH keys to access the GIT repository. 
                        </p>
                    </div>
                </div>

                <p>AND / OR</p>

                <p>
                    You can also add all your dotfiles (<code>.bash_aliases</code>, <code>.vimrc</code>, <code>.gitconfig</code>, etc), to the <code>./data/dot/</code> folder. During initial startup they will automatically be copied to the virtual machine.
                </p>
            </div>

        </div>
    </div>
</div>
<!-- end dotfiles -->
