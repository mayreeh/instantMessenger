<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h3>SMS SETTINGS  </h3>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Admin</a></li>
    <li class="active">AfricasTalking</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">AfricasTalking Gateway</h3>
</div>
<?php
$active_sms_service = $this->db->get_where('sms_settings' , array('account_id' => $this->session->userdata('user_id')))->row()->active;
?>
<div class="row">
	<div class="col-md-12">
    <div class="tabs-vertical-env">
      <ul class="nav tabs-vertical">
			<li class="active"><a href="#b-profile" data-toggle="tab">Activate SMS Service</a></li>
		    <li>
					<a href="#v-AT" data-toggle="tab">
						AfricasTalking Settings
						<?php if ($active_sms_service == 1):?>
							<span class="badge badge-success"><?php echo "active"; ?></span>
						<?php endif;?>
					</a>
				</li>
			</ul>

			<div class="tab-content">
        <div class="tab-pane active" id="b-profile">
          <?php echo form_open(base_url() . 'index.php?admin/sms_AT/active_service' ,
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="form-group">
						<label class="col-sm-3 control-label"><?php echo "select_a_service";?></label>
                        <div class="col-sm-5">
							<select name="active_sms_service" class="form-control selectboxit">
              	<option value="1"
										<?php if ($active_sms_service == 1) echo 'selected';?>>
											AfricasTalking
									</option>
              		<option value="0"<?php if ($active_sms_service == 0) echo 'selected';?>>
              			<?php echo "disabled";?>
              		</option>
                </select>
						</div>
					</div>
					<div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo "save"?></button>
              </div>
          </div>
	            <?php echo form_close();?>
				</div>

	      <div class="tab-pane" id="v-AT">
				<?php echo form_open(base_url() . 'index.php?admin/sms_AT/create' ,
					array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					<div class="form-group">
											<label  class="col-sm-3 control-label"><?php echo 'AfricasTalking_username';?></label>
												<div class="col-sm-5">
														<input type="text" class="form-control" name="AfricasTalking_username"
															value="<?php echo $this->db->get_where('sms_settings' , array('account_id' => $this->session->userdata('user_id')))->row()->username;?>">
												</div>
										</div>
										<div class="form-group">
											<label  class="col-sm-3 control-label"><?php echo 'AfricasTalking_api_id';?></label>
												<div class="col-sm-5">
														<input type="text" class="form-control" name="AfricasTalking_api_id"
																value="<?php echo $this->db->get_where('sms_settings' , array('account_id' => $this->session->userdata('user_id')))->row()->apikey;?>">
												</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-5">
													<button type="submit" class="btn btn-info"><?php echo 'save';?></button>
											</div>
									</div>
				<?php echo form_close();?>
				</div>

			</div>
	</div>
</div>
</div>

</div>
</section>
</div>
