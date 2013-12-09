<input type="hidden" name="vagrant[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$name.'.name') }}</h1>
</div>

@if (count($section->machine_types()))
<ul class="nav nav-pills nav-section">
    @foreach($section->machine_types() as $type => $name)
    <li class="{{ $type == 'local' ? 'active' : '' }}"><a href="#section-vagrant-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    <div class="tab-pane active" id="section-vagrant-local">
        <input type="hidden" id="vagrant-box" name="vagrant[box]" value="" />

        <!-- local virtual machine -->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Local Virtual Machine</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row form-group">
                            <div class="col-md-12 {{ $errors->first('vagrant.box_url', 'has-error') }}">
                                <label>Operating System</label>

                                @foreach($section->param('local_vm_os', []) as $os)
                                <label class="radio">
                                <input type="radio" class="update-input" name="vagrant[box_url]" value="{{ $os['url'] }}" data-update="vagrant-box:{{ $os['name'] }}" data-update="php-version:{{ $os['php'] }}">
                                {{ $os['label'] }}
                                @if (isset($os['php_versions']))
                                (PHP
                                @foreach($os['php_versions'] as $osphp)
                                <span class="label php-version-{{ str_replace('.', '-', $osphp) }}">{{ $osphp }}</span>
                                @endforeach
                                )
                                @endif
                                </label>
                                @endforeach

                                <p class="help-block">
                                Choose the operating system for your VM. It will be downloaded the first time you
                                run Vagrant. <a href="http://docs.vagrantup.com/v2/getting-started/boxes.html">More
                                information may be found here</a>.
                                </p>

                                <p class="help-block">
                                Note: Listed are the PHP installs that we have confirmed as working for their respective
                                operating system. You are welcome to attempt to install higher if you'd like, but
                                we cannot guarantee it will work. In fact in most cases it won't.
                                </p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 {{ $errors->first('vagrant.local_name', 'has-error') }}">
                                <label for="vagrant-local-name">Name Your Local VM</label>
                                <input type="text" id="vagrant-local-name" name="vagrant[local_name]" placeholder="{{ $section->param('local_vm_name') }}" value="{{ Input::old('vagrant.local_name', $section->param('local_vm_name')) }}" class="form-control">

                                <p class="help-block">
                                Your personal name for the box. Should be unique to your system.
                                If you have multiple boxes running, name each one differently.
                                </p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 {{ $errors->first('vagrant.local_ip', 'has-error') }}">
                                <label for="vagrant-local-ip">Local VM IP Address</label>
                                <input type="text" id="vagrant-local-ip" name="vagrant[local_ip]" placeholder="{{ $section->param('local_vm_ip') }}" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" oninvalid="setCustomValidity('IP address format: {{ $section->param('local_vm_ip') }}')" value="{{ Input::old('vagrant.local_ip', $section->param('local_vm_ip')) }}" class="form-control">

                                <p class="help-block">
                                IP address to use for accessing the VM. This is the IP address you will need to enter
                                into your <code>hosts</code> file for every virtual hosts you create later on.
                                </p>
                            </div>
                            <div class="col-md-6 {{ $errors->first('vagrant.local_memory', 'has-error') }}">
                                <label for="vagrant-local-memory">Local VM Memory</label>
                                <input type="number" id="vagrant-local-memory" name="vagrant[local_memory]" placeholder="{{ $section->param('local_vm_memory') }}" pattern="^[1-9][0-9]*$" min="64" value="{{ Input::old('vagrant.local_memory', $section->param('local_vm_memory')) }}" class="form-control">

                                <p class="help-block">Memory to assign to VM in megabytes (only integers)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>