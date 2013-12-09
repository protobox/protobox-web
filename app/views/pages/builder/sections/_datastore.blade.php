<input type="hidden" name="mysql[_prevent_empty]" />

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
                                    <input type="checkbox" id="mysql-install" name="mysql[install]" {{ $section->param('mysql_install') ? 'checked="checked"' : '' }} value="{{ $section->param('mysql_install') }}">
                                    Install
                                </label>

                                <p class="help-block">
                                You can toggle this setting to turn on/off the MySQL installation.
                                </p>
                            </div>
                        </div>
                        <!-- end mysql install -->

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="mysql-root_password">Root Password</label>
                                <input type="text" id="mysql-root_password" name="mysql[root_password]" value="{{ Input::old('datastore.mysql.root_password', $section->param('mysql_root_password')) }}" class="form-control">

                                <p class="help-block">
                                    Assign a password to the root user. <strong>Database will only be installed when a password is entered here.</strong>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <label for="mysql-phpmyadmin">phpMyAdmin</label><br>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="mysql-phpmyadmin" name="mysql[phpmyadmin]" value="1"> Install phpMyAdmin
                                </label>

                                <p class="help-block">
                                    If installed it will be available from <code>http://{SERVER_IP_ADDRESS}/phpmyadmin</code>.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end mysql msyql settings -->

        @foreach($section->param('mysql_databases', []) as $dbid => $db)
        <!-- mysql / database -->
        <div class="row" id="datastore-mysql-{{ $dbid }}">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">MySQL Database</h3>
                    </div>

                    <div class="panel-body">

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="mysql-{{ $dbid }}-grant">Privileges</label>

                                <select id="mysql-{{ $dbid }}-grant" name="mysql[databases][{{ $dbid }}][grant][]" multiple="multiple" size="6" class="form-control select-tags">
                                <option value="ALL" selected="selected"></option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="mysql-databases-{{ $dbid }}-name">DB Name</label>
                                <input type="text" id="mysql-databases-{{ $dbid }}-name" name="mysql[databases][{{ $dbid }}][name]" required="" placeholder="database name" value="" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="mysql-databases-{{ $dbid }}-host">DB Host</label>
                                <input type="text" id="mysql-databases-{{ $dbid }}-host" name="mysql[databases][{{ $dbid }}][host]" required="" placeholder="database host" value="localhost" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="mysql-databases-{{ $dbid }}-user">Username</label>
                                <input type="text" id="mysql-databases-{{ $dbid }}-user" name="mysql[databases][{{ $dbid }}][user]" required="" placeholder="username" value="" class="form-control">

                                <p class="help-block">
                                    At this time, one user can only be assigned to one database. You should not enter "root"
                                    here! You should not have a single user appear twice!
                                </p>
                            </div>

                            <div class="col-md-6">
                                <label for="mysql-databases-{{ $dbid }}-password">Password</label>
                                <input type="text" id="mysql-databases-{{ $dbid }}-password" name="mysql[databases][{{ $dbid }}][password]" required="" placeholder="password" value="" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="mysql-databases-{{ $dbid }}-sql_file">Import Database From File</label>
                                <input type="text" id="mysql-databases-{{ $dbid }}-sql_file" name="mysql[databases][{{ $dbid }}][sql_file]" placeholder="/var/www/sql/database_name.sql" value="" class="form-control">

                                <p class="help-block">
                                    Optional. Make sure this file is inside the VM before running
                                    <code>$ vagrant up</code>
                                </p>
                            </div>
                        </div>

                        <p class="text-center">
                            <button type="button" class="btn btn-danger btn-sm deleteParentContainer" data-parent-id="{{ $dbid }}">Remove this database</button>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <!-- end mysql database -->
        @endforeach

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-push-2">
                <button type="button" class="btn btn-success btn-lg btn-block addParentContainer" data-source-url="/extensions/mysql/add-database">Add another MySQL database</button>
            </div>
        </div>

    </div>
    <!-- end mysql -->

    <!-- postgresql -->
    <div class="tab-pane" id="section-datastore-postgresql">

        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>PostgreSQL</strong> is coming soon.
        </div>

    </div>
    <!-- end postgresql -->

    <!-- mariadb -->
    <div class="tab-pane" id="section-datastore-mariadb">

        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>MariaDB</strong> is coming soon.
        </div>

    </div>
    <!-- end mariadb -->

    <!-- mongodb -->
    <div class="tab-pane" id="section-datastore-mongodb">

        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Mongdb</strong> is coming soon.
        </div>

    </div>
    <!-- end mongodb -->

    <!-- redis -->
    <div class="tab-pane" id="section-datastore-redis">

        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Redis</strong> is coming soon.
        </div>

    </div>
    <!-- end redis -->

    <!-- riak -->
    <div class="tab-pane" id="section-datastore-riak">

        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Riak</strong> is coming soon.
        </div>

    </div>
    <!-- end riak -->
</div>