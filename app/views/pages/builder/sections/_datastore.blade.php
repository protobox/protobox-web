<div class="page-header">
    <h1>{{ trans('builder/'.$name.'.name') }}</h1>
</div>

@if (count($section->drivers()))
<ul class="nav nav-pills nav-section">
    @foreach($section->drivers() as $type => $name)
    <li class="{{ $type == 'mysql' ? 'active' : '' }}"><a href="#section-datastore-{{ $type }}" data-toggle="tab">{{ $name }}</a></li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    <!-- mysql -->
    <div class="tab-pane active" id="section-datastore-mysql">
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
                                <input type="text" id="mysql-root_password" name="mysql[root_password]" value="{{ Input::old('datastore.mysql.root_password', $section->param('mysql_root_password')) }}" class="form-control">

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

    </div>
    <!-- end mysql -->

    <!-- mariadb -->
    <div class="tab-pane" id="section-datastore-mariadb">
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
                            <div class="col-md-12">
                                <label for="mariadb-install">
                                    <input type="checkbox" id="mariadb-install" name="mariadb[install]" {{ Input::old('mariadb.install', $section->param('mariadb_install')) ? 'checked="checked"' : '' }} value="1">
                                    Install
                                </label>

                                <p class="help-block">
                                You can toggle this setting to turn on/off the MariaDB installation.
                                </p>
                            </div>
                        </div>
                        <!-- end mariadb install -->
                    </div>

                </div>
            </div>
        </div>
        <!-- end mariadb settings -->

    </div>
    <!-- end mariadb -->

    <!-- mariadb -->
    <div class="tab-pane" id="section-datastore-mariadb">

        <div class="alert alert-warning fade in">
            <strong>MariaDB</strong> is coming soon.
        </div>

    </div>
    <!-- end mariadb -->

    <!-- postgresql -->
    <div class="tab-pane" id="section-datastore-postgresql">

        <div class="alert alert-warning fade in">
            <strong>PostgreSQL</strong> is coming soon.
        </div>

    </div>
    <!-- end postgresql -->

    <!-- mongodb -->
    <div class="tab-pane" id="section-datastore-mongodb">

        <div class="alert alert-warning fade in">
            <strong>Mongdb</strong> is coming soon.
        </div>

    </div>
    <!-- end mongodb -->

    <!-- redis -->
    <div class="tab-pane" id="section-datastore-redis">

        <div class="alert alert-warning fade in">
            <strong>Redis</strong> is coming soon.
        </div>

    </div>
    <!-- end redis -->

    <!-- riak -->
    <div class="tab-pane" id="section-datastore-riak">

        <div class="alert alert-warning fade in">
            <strong>Riak</strong> is coming soon.
        </div>

    </div>
    <!-- end riak -->
</div>