<input type="hidden" name="applications[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$name.'.name') }}</h1>
</div>

<div class="row application-selection">
    <div class="form-inline form-group">
    	<div class="col-md-12">
			<label for="application-select">New Application:</label> 
			<select id="application-select" class="form-control">
				@foreach($section->applications() as $application => $name)
				<option value="{{ $application }}">{{ $name }}</option>
				@endforeach
			</select>

			<button type="button" class="btn btn-success" data-application="application-select" data-replace="appid:[id]" data-append="#application-group">Add Application</button>
    	</div>
    </div>
</div>

<div id="application-group">
@foreach(Input::old('applications', $section->param('applications', [])) as $app_type => $app)
<!-- application / {{ $app_type }} -->
@include('pages.builder.sections.application._'.$app_type, ['type' => 'data'])
<!-- end application / {{ $app_type }} -->
@endforeach
</div>

@foreach($section->applications() as $app_type => $name)
<script type="text/template" id="application-{{ $app_type }}-template">
<!-- application / {{ $app_type }} -->
@include('pages.builder.sections.application._'.$app_type, ['type' => 'template', 'appid' => '{appid}'])
<!-- end application / {{ $app_type }} -->
</script>
@endforeach