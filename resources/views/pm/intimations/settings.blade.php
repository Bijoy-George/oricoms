@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Project Intimation Settings
@endsection

@section('content')
<div class="content-area">
	<div class="row justify-content-center">
		<div class="col-sm-10 mt-3">
			<div class="widget">
				<h2>{{__('Project Intimation Settings')}}</h2>
				<div class="widget-content pt-3">
					@if (isset($project_intimations))
						{!! Form::model($project_intimations, ['method' => 'POST', 'class' => 'form-common', 'url' => '/project_intimations']) !!}
					@else
						{!! Form::open(array('url' => '/project_intimations', 'class' => 'form-common', 'method'=>'POST')) !!}
					@endif
						{{ csrf_field() }}
						{{ Form::hidden('id') }}
						<div class="row m-0 align-items-center">
							<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">      
									<a class="nav-item nav-link active show" id="nav-profile-tab" data-toggle="tab" href="#project_assignment" role="tab" aria-controls="basic-prof" aria-selected="false">Project Assignment</a>

									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#project_near_due" role="tab" aria-controls="project_near_due" aria-selected="true">Project Near Due</a>

									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#project_overdue" role="tab" aria-controls="project_overdue" aria-selected="true">Project Overdue</a>

									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#project_completion" role="tab" aria-controls="project_completion" aria-selected="true">Project Completion</a>

									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#task_assignment" role="tab" aria-controls="task_assignment" aria-selected="true">Task Assignment</a>

									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#task_near_due" role="tab" aria-controls="task_near_due" aria-selected="true">Task Near Due</a>

									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#task_overdue" role="tab" aria-controls="task_overdue" aria-selected="true">Task Overdue</a>

									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#task_completion" role="tab" aria-controls="task_completion" aria-selected="true">Task Completion</a>
									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#daily_intimations" role="tab" aria-controls="daily_intimations" aria-selected="true">Daily Intimations</a>
									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#monthly_intimations" role="tab" aria-controls="monthly_intimations" aria-selected="true">Monthly Intimations</a>
									
								</div>
							</nav>
							<div class="tab-content col-md-12 mb-3" id="nav-tabContent">
								<div class="tab-pane fade box-shadow active show p-3" id="project_assignment" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check">
												{{ Form::checkbox('project_assignment_intimations_members', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_assignment_intimations_members']) }}
											    <label class="form-check-label" for="project_assignment_intimations_members">Members</label>
										  	</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
												{{ Form::checkbox('project_assignment_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_assignment_intimations_lead']) }}
											    <label class="form-check-label" for="project_assignment_intimations_lead">Project Lead</label>
										  	</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											    <label class="form-check-label" for="project_assignment_intimations_members_mail">Members Mail</label>
												{{ Form::select('project_assignment_intimations_members_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_assignment_intimations_members_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
												<label class="form-check-label" for="project_assignment_intimations_members_mail">Project Lead Mail</label>
												{{ Form::select('project_assignment_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_assignment_intimations_lead_mail']) }}
										</div>
									</div>
								</div>

								<div class="tab-pane fade box-shadow p-3" id="project_near_due" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											    <label class="form-check-label" for="project_near_due_intimation_period">Period (in days):</label>
											    {{ Form::number('project_near_due_intimation_period', NULL, ['class' => 'form-control', 'id' => 'project_near_due_intimation_period']) }}
										</div>
									</div>
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check"> 
										    	{{ Form::checkbox('project_near_due_intimations_members', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_near_due_intimations_members']) }}
										    	<label class="form-check-label" for="project_near_due_intimations_members">Members</label>
											</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
										    	{{ Form::checkbox('project_near_due_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_near_due_intimations_lead']) }}
										    	<label class="form-check-label" for="project_near_due_intimations_lead">Project Lead</label>
											</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
										    {{ Form::checkbox('project_near_due_intimations_creator', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_near_due_intimations_creator']) }}
										    <label class="form-check-label" for="project_near_due_intimations_creator">Project Creator</label>
											</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-check">
											<label class="form-check-label" for="project_near_due_intimations_members_mail">Members Mail</label>
											{{ Form::select('project_near_due_intimations_members_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_near_due_intimations_members_mail']) }}
										</div>

										<div class="col-sm-4 form-check">
											<label class="form-check-label" for="project_near_due_intimations_lead_mail">Project Lead Mail</label>
											{{ Form::select('project_near_due_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_near_due_intimations_lead_mail']) }}
										</div>

										<div class="col-sm-4 form-check">
											<label class="form-check-label" for="project_near_due_intimations_creator_mail">Project Creator Mail</label>
											{{ Form::select('project_near_due_intimations_creator_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_near_due_intimations_creator_mail']) }}
										</div>
									</div>
								</div>

								<div class="tab-pane fade box-shadow p-3" id="project_overdue" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											    <label class="form-check-label" for="project_overdue_intimation_period">Period (in days):</label>
											    {{ Form::number('project_overdue_intimation_period', NULL, ['class' => 'form-control', 'id' => 'project_overdue_intimation_period']) }}
										</div>
									</div>
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check"> 
										    	{{ Form::checkbox('project_overdue_intimations_members', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_overdue_intimations_members']) }}
										    	<label class="form-check-label" for="project_overdue_intimations_members">Members</label>
											</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
												{{ Form::checkbox('project_overdue_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_overdue_intimations_lead']) }}
										    	<label class="form-check-label" for="project_overdue_intimations_lead">Project Lead</label>
											</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
												{{ Form::checkbox('project_overdue_intimations_creator', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_overdue_intimations_creator']) }}
										    	<label class="form-check-label" for="project_overdue_intimations_creator">Project Creator</label>
											</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-check">
											<label class="form-check-label" for="project_overdue_intimations_members_mail">Members Mail</label>
											{{ Form::select('project_overdue_intimations_members_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_overdue_intimations_members_mail']) }}
										</div>

										<div class="col-sm-4 form-check">
											<label class="form-check-label" for="project_overdue_intimations_lead_mail">Project Lead Mail</label>
											{{ Form::select('project_overdue_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_overdue_intimations_lead_mail']) }}
										</div>

										<div class="col-sm-4 form-check">
											<label class="form-check-label" for="project_overdue_intimations_creator_mail">Project Creator Mail</label>
											{{ Form::select('project_overdue_intimations_creator_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_overdue_intimations_creator_mail']) }}
										</div>
									</div>
								</div>

								<div class="tab-pane fade box-shadow p-3" id="project_completion" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check">
											    {{ Form::checkbox('project_completion_intimations_members', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_completion_intimations_members']) }}
											    <label class="form-check-label" for="project_completion_intimations_members">Members</label>
										  	</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
												{{ Form::checkbox('project_completion_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_completion_intimations_lead']) }}
											    <label class="form-check-label" for="project_completion_intimations_lead">Project Lead</label>
										  	</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
												{{ Form::checkbox('project_completion_intimations_creator', 1, NULL, ['class' => 'form-check-input', 'id' => 'project_completion_intimations_creator']) }}
											    <label class="form-check-label" for="project_completion_intimations_creator">Project Creator</label>
										  	</div>
										</div>
									</div>

									<div class="row row-eq-height my-2">
										<div class="col-sm-4 form-group">
											<label class="form-label" for="project_completion_intimations_members_mail">Members Mail</label>
											{{ Form::select('project_completion_intimations_members_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_completion_intimations_members_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
											<label class="form-label" for="project_completion_intimations_lead_mail">Project Lead Mail</label>
											{{ Form::select('project_completion_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_completion_intimations_lead_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
											<label class="form-label" for="project_completion_intimations_creator_mail">Project Creator Mail</label>
											{{ Form::select('project_completion_intimations_creator_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'project_completion_intimations_creator_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
											<label class="form-label" for="project_completion_status">Project Completion Status</label>
											{{ Form::select('project_completion_status', $project_status, NULL, ['class' => 'form-control', 'id' => 'project_completion_status']) }}
										</div>
									</div>
								</div>

								<div class="tab-pane fade box-shadow p-3" id="task_assignment" role="tabpanel" aria-labelledby="nav-profile-tab">

									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check">
											    {{ Form::checkbox('task_assignment_intimations', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_assignment_intimations']) }}
											    <label class="form-check-label" for="task_assignment_intimations">Intimations to assigned members</label>
										  	</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<label class="form-check-label" for="task_assignment_intimations_mail">Members Mail</label>
											{{ Form::select('task_assignment_intimations_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_assignment_intimations_mail']) }}
										</div>
									</div>
								</div>

								<div class="tab-pane fade box-shadow p-3" id="task_near_due" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											    <label class="form-check-label" for="task_near_due_intimation_period">Period (in days):</label>
											    {{ Form::number('task_near_due_intimation_period', NULL, ['class' => 'form-control', 'id' => 'task_near_due_intimation_period']) }}
										</div>
									</div>
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check"> 
											    {{ Form::checkbox('task_near_due_intimations_members', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_near_due_intimations_members']) }}
											    <label class="form-check-label" for="task_near_due_intimations_members">Assigned Members</label>
											</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
											    {{ Form::checkbox('task_near_due_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_near_due_intimations_lead']) }}
											    <label class="form-check-label" for="task_near_due_intimations_lead">Project Lead</label>
											</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
											    {{ Form::checkbox('task_near_due_intimations_creator', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_near_due_intimations_creator']) }}
											    <label class="form-check-label" for="task_near_due_intimations_creator">Project Creator</label>
											</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_near_due_intimations_members_mail">Members Mail</label>
											{{ Form::select('task_near_due_intimations_members_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_near_due_intimations_members_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_near_due_intimations_lead_mail">Project Lead Mail</label>
											{{ Form::select('task_near_due_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_near_due_intimations_lead_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_near_due_intimations_creator_mail">Project Creator Mail</label>
											{{ Form::select('task_near_due_intimations_creator_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_near_due_intimations_creator_mail']) }}
										</div>
									</div>
								</div>

								<div class="tab-pane fade box-shadow p-3" id="task_overdue" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											    <label class="form-check-label" for="task_overdue_intimation_period">Period (in days):</label>
											    {{ Form::number('task_overdue_intimation_period', NULL, ['class' => 'form-control', 'id' => 'task_overdue_intimation_period']) }}
										</div>
									</div>
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check"> 
										    {{ Form::checkbox('task_overdue_intimations_members', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_overdue_intimations_members']) }}
										    <label class="form-check-label" for="task_overdue_intimations_members">Assigned Members</label>
											</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check"> 
											    {{ Form::checkbox('task_overdue_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_overdue_intimations_lead']) }}
											    <label class="form-check-label" for="task_overdue_intimations_lead">Project Lead</label>
											</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check"> 
											    {{ Form::checkbox('task_overdue_intimations_creator', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_overdue_intimations_creator']) }}
											    <label class="form-check-label" for="task_overdue_intimations_creator">Task Creator</label>
											</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_overdue_intimations_members_mail">Members Mail</label>
											{{ Form::select('task_overdue_intimations_members_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_overdue_intimations_members_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_overdue_intimations_lead_mail">Project Lead Mail</label>
											{{ Form::select('task_overdue_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_overdue_intimations_lead_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_overdue_intimations_creator_mail">Project Creator Mail</label>
											{{ Form::select('task_overdue_intimations_creator_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_overdue_intimations_creator_mail']) }}
										</div>
									</div>
								</div>

								<div class="tab-pane fade box-shadow p-3" id="task_completion" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check">
											    {{ Form::checkbox('task_completion_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_completion_intimations_lead']) }}
											    <label class="form-check-label" for="task_completion_intimations_lead">Project Lead</label>
										  	</div>
										</div>

										<div class="col-sm-4 form-group">
											<div class="form-check">
											    {{ Form::checkbox('task_completion_intimations_creator', 1, NULL, ['class' => 'form-check-input', 'id' => 'task_completion_intimations_creator']) }}
											    <label class="form-check-label" for="task_completion_intimations_creator">Task Creator</label>
										  	</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_completion_intimations_lead_mail">Project Lead Mail</label>
											{{ Form::select('task_completion_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_completion_intimations_lead_mail']) }}
										</div>

										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_completion_intimations_creator_mail">Project Creator Mail</label>
											{{ Form::select('task_completion_intimations_creator_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'task_completion_intimations_creator_mail']) }}
										</div>
										<div class="col-sm-4 form-group">
											<label class="form-label" for="task_completion_status">Task Completion Status</label>
											{{ Form::select('task_completion_status', $task_status, NULL, ['class' => 'form-control', 'id' => 'task_completion_status']) }}
										</div>
									</div>
								</div>
								<!-- daily-intimations -->
								<div class="tab-pane fade box-shadow p-3" id="daily_intimations" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check">
											    {{ Form::checkbox('daily_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'daily_intimations_lead']) }}
											    <label class="form-check-label" for="daily_intimations_lead">Project Lead</label>
										  	</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<label class="form-label" for="daily_intimations_lead_mail">Project Lead Mail</label>
											{{ Form::select('daily_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'daily_intimations_lead_mail']) }}

										</div>
									</div>
								</div>
								<!-- Monthly-intimations -->
								<div class="tab-pane fade box-shadow p-3" id="monthly_intimations" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<div class="form-check">
											    {{ Form::checkbox('monthly_intimations_lead', 1, NULL, ['class' => 'form-check-input', 'id' => 'monthly_intimations_lead']) }}
											    <label class="form-check-label" for="monthly_intimations_lead">Project Lead</label>
										  	</div>
										</div>
									</div>

									<div class="row row-eq-height">
										<div class="col-sm-4 form-group">
											<label class="form-label" for="monthly_intimations_lead_mail">Project Lead Mail</label>
											{{ Form::select('monthly_intimations_lead_mail', $mail_templates, NULL, ['class' => 'form-control', 'id' => 'monthly_intimations_lead_mail']) }}

										</div>
									</div>
								</div>

								<!-- end -->
								<div class="col-md-12 text-right">
									<button type="reset" class="btn btn-outline-danger btn-sm px-4">Reset</button>
									<button type="submit" class="btn btn-primary btn-sm px-4"> Save </button>
								</div>
							</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection