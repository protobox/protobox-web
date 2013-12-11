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
                        <option value="ALL" selected="selected">ALL</option>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="mysql-databases-{{ $dbid }}-name">DB Name</label>
                        <input type="text" id="mysql-databases-{{ $dbid }}-name" name="mysql[databases][{{ $dbid }}][name]" placeholder="database name" value="" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="mysql-databases-{{ $dbid }}-host">DB Host</label>
                        <input type="text" id="mysql-databases-{{ $dbid }}-host" name="mysql[databases][{{ $dbid }}][host]" placeholder="database host" value="localhost" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="mysql-databases-{{ $dbid }}-user">Username</label>
                        <input type="text" id="mysql-databases-{{ $dbid }}-user" name="mysql[databases][{{ $dbid }}][user]" placeholder="username" value="" class="form-control">

                        <p class="help-block">
                            At this time, one user can only be assigned to one database. You should not enter "root"
                            here! You should not have a single user appear twice!
                        </p>
                    </div>

                    <div class="col-md-6">
                        <label for="mysql-databases-{{ $dbid }}-password">Password</label>
                        <input type="text" id="mysql-databases-{{ $dbid }}-password" name="mysql[databases][{{ $dbid }}][password]" placeholder="password" value="" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="mysql-databases-{{ $dbid }}-sql_file">Import Database From File</label>
                        <input type="text" id="mysql-databases-{{ $dbid }}-sql_file" name="mysql[databases][{{ $dbid }}][sql_file]" placeholder="/vagrant/data/sql/database_name.sql" value="" class="form-control">

                        <p class="help-block">
                            Optional. Make sure this file is inside the VM before running
                            <code>$ vagrant up</code>
                        </p>
                    </div>
                </div>

                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-template-remove="#datastore-mysql-{{ $dbid }}" data-template-id="{{ $dbid }}">Remove this database</button>
                </p>
            </div>

        </div>
    </div>
</div>