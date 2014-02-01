<input type="hidden" name="ruby[_prevent_empty]" />

<!-- ruby settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Ruby Settings</h3>
            </div>

            <div class="panel-body">
                <!-- ruby install -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="ruby-install">
                            <input type="checkbox" id="ruby-install" name="ruby[install]" {{ Input::old('ruby.install', $section->param('ruby_install')) ? 'checked="checked"' : '' }} value="1">
                            Install                        </label>


                        <p class="help-block">
                        You can toggle this setting to turn on/off the Ruby installation.
                        </p>
                    </div>
                </div>
                <!-- end ruby install -->

				<!-- ruby gems -->
                <div class="row form-group">
                    <div class="col-xs-12">
                        <label for="ruby-gems">Ruby Gems</label>
                        <select id="ruby-gems" name="ruby[gems][]" multiple="multiple" class="form-control select-tags-editable">
                            @foreach(Input::old('ruby.gems', $section->param('ruby_gems', [])) as $package)
                            <option selected value="{{ $package }}">{{ $package }}</option>
                            @endforeach
                        </select>

                        <p class="help-block">
                            Ruby gems to install.
                        </p>
                    </div>
                </div>
				<!-- end ruby gems -->
            </div>
        </div>
    </div>
</div>
<!-- end ruby settings -->
