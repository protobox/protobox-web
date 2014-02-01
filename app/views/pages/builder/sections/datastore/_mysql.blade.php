<input type="hidden" name="mysql[_prevent_empty]" />

<!-- msyql settings -->
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">MySQL Settings</h3>
            </div>

            <div class="panel-body">
                <!-- mysql install -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="mysql-install">
                            <input type="checkbox" id="mysql-install" name="mysql[install]" {{ Input::old('mysql.install', $section->param('mysql_install')) ? 'checked="checked"' : '' }} value="1">
                            Install
                        </label>

                        <p class="help-block">
                        You can toggle this setting to turn on/off the MySQL installation.
                        </p>
                    </div>
                </div>
                <!-- end mysql install -->

                <!-- root password -->
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="mysql-root_password">Root Password</label>
                        <input type="text" id="mysql-root_password" name="mysql[root_password]" value="{{ Input::old('mysql.root_password', $section->param('mysql_root_password')) }}" class="form-control">

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
<!-- end mysql settings -->

@foreach(Input::old('mysql.databases', $section->param('mysql_databases', [])) as $dbid => $db)
<!-- mysql / databases -->
@include('pages.builder.sections.datastore._mysql_database', ['type' => 'data'])
<!-- end mysql / databases -->
@endforeach

<script type="text/template" id="mysql-database-template">
<!-- mysql / databases -->
@include('pages.builder.sections.datastore._mysql_database', ['type' => 'template', 'dbid' => '{dbid}'])
<!-- end mysql / databases -->
</script>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-push-2">
        <button type="button" class="btn btn-success btn-lg btn-block" data-template="#mysql-database-template" data-id-start="{{ count(Input::old('mysql.databases', $section->param('mysql_databases', []))) }}" data-replace="dbid:[id],dbnewid:[newid]" data-append=".row">Add another MySQL database</button>
    </div>
</div>
