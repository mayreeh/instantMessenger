<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h3>SMS GATEWAY SETTINGS  </h3>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">admin</a></li>
    <li class="active">Sms Gateway Settings</li>
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
	$active_sms_service = $this->db->get_where('system_settings' , array(
		'type' => 'active_sms_service'
	))->row()->description;
?>
<div class="row">
	<div class="col-md-12">

		<div class="tabs-vertical-env">

			<ul class="nav tabs-vertical">
			<li class="active"><a href="#b-profile" data-toggle="tab">Select A SMS Service</a></li>
				<li>
					<a href="#v-home" data-toggle="tab">
						Clickatell Settings
						<?php if ($active_sms_service == 'clickatell'):?>
							<span class="badge badge-success"><?php echo get_phrase('active');?></span>
						<?php endif;?>
					</a>
				</li>
				<li>
					<a href="#v-profile" data-toggle="tab">
						Twilio Settings
						<?php if ($active_sms_service == 'twilio'):?>
							<span class="badge badge-success"><?php echo get_phrase('active');?></span>
						<?php endif;?>
					</a>
				</li>
				<li>
					<a href="#v-AT" data-toggle="tab">
						AfricasTalking Settings
						<?php if ($active_sms_service == 'AfricasTalking'):?>
							<span class="badge badge-success"><?php echo "active"; ?></span>
						<?php endif;?>
					</a>
				</li>
			</ul>

			<div class="tab-content">

				<div class="tab-pane active" id="b-profile">

					<?php echo form_open(base_url() . 'index.php?admin/sms_settings/active_service' ,
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo "select_a_service";?></label>
                        <div class="col-sm-5">
							<select name="active_sms_service" class="form-control selectboxit">
                              <option value=""<?php if ($active_sms_service == '') echo 'selected';?>>
                              		<?php echo "not_selected";?>
                              	</option>
                        		<option value="clickatell"
                        			<?php if ($active_sms_service == 'clickatell') echo 'selected';?>>
                        				Clickatell
                        		</option>
                        		<option value="twilio"
                        			<?php if ($active_sms_service == 'twilio') echo 'selected';?>>
                        				Twilio
                        		</option>
														<option value="AfricasTalking"
															<?php if ($active_sms_service == 'AfricasTalking') echo 'selected';?>>
																AfricasTalking
														</option>
                        		<option value="disabled"<?php if ($active_sms_service == 'disabled') echo 'selected';?>>
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

				<div class="tab-pane" id="v-home">
					<?php echo form_open(base_url() . 'index.php?admin/sms_settings/clickatell' ,
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="form-group">
	                      <label  class="col-sm-3 control-label"><?php echo "clickatell_username"?></label>
	                      	<div class="col-sm-5">
	                          	<input type="text" class="form-control" name="clickatell_user"
	                            	value="<?php echo $this->db->get_where('system_settings' , array('type' =>'clickatell_user'))->row()->description;?>">
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                        <label  class="col-sm-3 control-label"><?php echo 'clickatell_password';?></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="clickatell_password"
	                                value="<?php echo $this->db->get_where('system_settings' , array('type' =>'clickatell_password'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                      <label  class="col-sm-3 control-label"><?php echo 'clickatell_api_id';?></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="clickatell_api_id"
	                                value="<?php echo $this->db->get_where('system_settings' , array('type' =>'clickatell_api_id'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-5">
		                        <button type="submit" class="btn btn-info"><?php echo 'save';?></button>
		                    </div>
		                </div>
	                <?php echo form_close();?>
				</div>
				<div class="tab-pane" id="v-profile">
					<?php echo form_open(base_url() . 'index.php?admin/sms_settings/twilio' ,
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="form-group">
	                      <label  class="col-sm-3 control-label"><?php echo 'twilio_account';?> SID</label>
	                      	<div class="col-sm-5">
	                          	<input type="text" class="form-control" name="twilio_account_sid"
	                            	value="<?php echo $this->db->get_where('system_settings' , array('type' =>'twilio_account_sid'))->row()->description;?>">
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                        <label  class="col-sm-3 control-label"><?php echo 'authentication_token';?></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="twilio_auth_token"
	                                value="<?php echo $this->db->get_where('system_settings' , array('type' =>'twilio_auth_token'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                      <label  class="col-sm-3 control-label"><?php echo 'registered_phone_number';?></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="twilio_sender_phone_number"
	                                value="<?php echo $this->db->get_where('system_settings' , array('type' =>'twilio_sender_phone_number'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-5">
		                        <button type="submit" class="btn btn-info"><?php echo 'save';?></button>
		                    </div>
		                </div>
	                <?php echo form_close();?>
				</div>
				<div class="tab-pane" id="v-AT">
					<?php echo form_open(base_url() . 'index.php?admin/sms_settings/AT' ,
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="form-group">
												<label  class="col-sm-3 control-label"><?php echo 'AfricasTalking_username';?></label>
													<div class="col-sm-5">
															<input type="text" class="form-control" name="AfricasTalking_username"
																value="<?php echo $this->db->get_where('system_settings' , array('type' =>'AfricasTalking_username'))->row()->description;?>">
													</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-3 control-label"><?php echo 'AfricasTalking_api_id';?></label>
													<div class="col-sm-5">
															<input type="text" class="form-control" name="AfricasTalking_api_id"
																	value="<?php echo $this->db->get_where('system_settings' , array('type' =>'AfricasTalking_api_id'))->row()->description;?>">
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
