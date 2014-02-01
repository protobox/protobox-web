<input type="hidden" name="mariadb[_prevent_empty]" />

<!-- mariadb settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">MariaDB Settings</h3>
            </div>

            <div class="panel-body">
                <!-- mariadb install -->
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="mariadb-install">
                            <input type="checkbox" id="mariadb-install" name="mariadb[install]" {{ Input::old('mariadb.install', $section->param('mariadb_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the MariaDB installation.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label>Version</label><br>

                        @foreach($section->param('mariadb_versions', []) as $i => $ver)
                        <label class="radio-inline">
                            <input type="radio" name="mariadb[version]" value="{{ $ver }}" {{ Input::old('mariadb.version', $i == 0 ? $ver : '') == $ver ? 'checked="checked"' : '' }}>
                            {{ $ver }}
                        </label>
                        @endforeach

                        <p class="help-block">
                        Read more about <a href="http://en.wikipedia.org/wiki/MariaDB#Versioning" target="_blank">MariaDB versioning</a>.
                        </p>
                    </div>
                </div>
                <!-- end mariadb install -->

                <!-- root password -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="mariadb-root_password">Root Password</label>
                        <input type="text" id="mariadb-root_password" name="mariadb[root_password]" value="{{ Input::old('mariadb.root_password', $section->param('mariadb_root_password')) }}" class="form-control">

                        <p class="help-block">
                            Assign a password to the root user. <strong>Database will only be installed when a password is entered here.</strong>
                        </p>
                    </div>
                </div>
                <!-- end root password -->
            </div>
        </div>
    </div>
</div>
<!-- end mariadb settings -->

@foreach(Input::old('mariadb.databases', $section->param('mariadb_databases', [])) as $dbid => $db)
<!-- mysql / databases -->
@include('pages.builder.sections.datastore._mariadb_database', ['type' => 'data'])
<!-- end mysql / databases -->
@endforeach

<script type="text/template" id="mariadb-database-template">
<!-- mariadb / databases -->
@include('pages.builder.sections.datastore._mariadb_database', ['type' => 'template', 'dbid' => '{dbid}'])
<!-- end mariadb / databases -->
</script>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-push-2">
        <button type="button" class="btn btn-success btn-lg btn-block" data-template="#mariadb-database-template" data-id-start="{{ count(Input::old('mariadb.databases', $section->param('mariadb_databases', []))) }}" data-replace="dbid:[id],dbnewid:[newid]" data-append=".row">Add another MariaDB database</button>
    </div>
</div>