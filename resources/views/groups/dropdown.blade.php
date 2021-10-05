<div class="dropdown-mul-1 form-group">
    <select style="display:none" name="groups" id="groups" class="form-control" multiple placeholder="Select Groups">
	    @foreach($groups as $group)
			<option value="{{$group->id}}" >{{$group->name}}({{ count($group->contacts) }})</option>
		@endforeach
    </select>
    <input type="hidden" id="groupJsonData" value="{{ $groups_json_list }}">
</div>
<span class="error" id ="groups_err"></span>

<script src="{{ asset('js/groups/dropdown.js') }}"></script>