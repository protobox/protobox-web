@if($next_section = $builder->next_section($section_name))
<div class="next-section">
    <div class="row">
        <div class="col-xs-12">
        	<p class="configuration-note pull-left">If you are done configuring, click the big button below.</p>
            <a class="btn btn-default pull-right" href="#" data-tab-switch="sel-{{ $next_section }}">
                Next Section
            </a>
        </div>
    </div>
</div>
@endif