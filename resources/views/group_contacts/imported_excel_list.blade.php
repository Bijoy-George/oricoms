<div class="widget">
	<h2>Imported Excel List</h2>
	<div class="col-md-12">
		<table width="100%" class="table table-responsive table-bordered">
			<thead>
				<tr>
					<th>File Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($excel_batches as $batch)
					<tr>
						<td>{{ $batch->file_name }}</td>
						<td>
							<button title="Download Failed Report" class="btn btn-link" data-batch="{{ $batch->id }}" onclick="downloadFailedImportReport(this)"><i class="material-icons">archive</i></button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>