<div class="row" id="datastore-mariadb-{{ $dbid }}">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">MariaDB Database #{{ $type != 'template' ? (int) $dbid + 1 : '{dbnewid}' }}</h3>
            </div>

            <div class="panel-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="mariadb-databases-{{ $dbid }}-name">DB Name</label>
                        <input type="text" id="mariadb-databases-{{ $dbid }}-name" name="mariadb[databases][{{ $dbid }}][name]" placeholder="{{ $type == 'template' ? $section->param('mariadb_database_name') : (isset($db['name']) ? $db['name'] : '') }}" value="{{ $type == 'template' ? $section->param('mariadb_database_name') : (isset($db['name']) ? $db['name'] : '') }}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="mariadb-databases-{{ $dbid }}-host">DB Host</label>
                        <input type="text" id="mariadb-databases-{{ $dbid }}-host" name="mariadb[databases][{{ $dbid }}][host]" placeholder="{{ $type == 'template' ? $section->param('mariadb_database_host') : (isset($db['host']) ? $db['host'] : '') }}" value="{{ $type == 'template' ? $section->param('mariadb_database_host') : (isset($db['host']) ? $db['host'] : '') }}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="mariadb-databases-{{ $dbid }}-user">Username</label>
                        <input type="text" id="mariadb-databases-{{ $dbid }}-user" name="mariadb[databases][{{ $dbid }}][user]" placeholder="{{ $type == 'template' ? $section->param('mariadb_database_user') : (isset($db['user']) ? $db['user'] : '') }}" value="{{ $type == 'template' ? $section->param('mariadb_database_user') : (isset($db['user']) ? $db['user'] : '') }}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="mariadb-databases-{{ $dbid }}-password">Password</label>
                        <input type="text" id="mariadb-databases-{{ $dbid }}-password" name="mariadb[databases][{{ $dbid }}][password]" placeholder="{{ $type == 'template' ? $section->param('mariadb_database_password') : (isset($db['password']) ? $db['password'] : '') }}" value="{{ $type == 'template' ? $section->param('mariadb_database_password') : (isset($db['password']) ? $db['password'] : '') }}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="mariadb-{{ $dbid }}-grant">Privileges</label>
                        <select id="mariadb-{{ $dbid }}-grant" name="mariadb[databases][{{ $dbid }}][grant][]" multiple="multiple" size="6" class="form-control select-tags">
                        @if($type == 'template')
                            @foreach($section->param('mariadb_database_grant') as $grant)
                            <option value="{{ $grant }}" selected="selected">{{ $grant }}</option>
                            @endforeach
                        @elseif(isset($db['grant']))
                            @foreach($db['grant'] as $grant)
                            <option value="{{ $grant }}" selected="selected">{{ $grant }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="mariadb-databases-{{ $dbid }}-sql_file">Import Database From File</label>
                        <input type="text" id="mariadb-databases-{{ $dbid }}-sql_file" name="mariadb[databases][{{ $dbid }}][sql_file]" placeholder="/vagrant/data/sql/database_name.sql" value="{{ $type == 'template' ? $section->param('mariadb_database_sql_file') : (isset($db['sql_file']) ? $db['sql_file'] : '') }}" class="form-control">

                        <p class="help-block">
                            Protobox will import the databases automatically if a <code>DB_NAME.sql</code> is found at <code>./data/sql/DB_NAME.sql</code>. Optionally you can specify an import file manually above. Make sure this file is inside the VM before running <code>$ vagrant up</code>
                        </p>
                    </div>
                </div>

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#datastore-mariadb-{{ $dbid }}" data-template-id="{{ $dbid }}">Remove this database</button>
                </p>
            </div>

        </div>
    </div>
</div>