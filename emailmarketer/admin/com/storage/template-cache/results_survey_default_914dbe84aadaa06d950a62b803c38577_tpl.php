<?php $IEM = $tpl->Get('IEM'); ?><link rel="stylesheet" type="text/css" href="addons/surveys/styles/tableselector.css" />
<link rel="stylesheet" type="text/css" href="addons/surveys/styles/view.response.css" />

<script src="includes/js/jquery/plugins/jquery.tableSelector.js"></script>
<script src="includes/js/jquery/plugins/jquery.jFrame.js"></script>

<script type="text/javascript">
		// form module jFrame instance
		new jFrame({
			controllerPath : 'addons/surveys/js/',
			cache          : false
		}, 'moduleForm');
		
	jFrame.getInstance('moduleForm').dispatch('result.survey');
	
</script>

	<h2 class="PageTitle"><?php echo GetLang('Addon_Surveys_ResultsDefaultTitle'); ?></h2>
	<div class="PageDescription"><?php echo GetLang('Addon_Surveys_ResultsDefaultDescription'); ?></div>
	<div id="MainMessage"><?php echo $tpl->Get('flashMessage'); ?></div>
	
	<?php if($tpl->Get('surveys')): ?>
		<form id="form-responses" action="index.php?Page=Addons&Addon=surveys&Action=result" method="post">	
			<h3 class="Heading2"><?php echo GetLang('Addon_Surveys_ResultsDefaultForm'); ?></h3>
			<fieldset class="inline">
				<ul>
					<li>
						<label>
							 <span class="required">*</span> <?php echo GetLang('Addon_Surveys_ResultsSurveySelect'); ?>
						</label>
						<div>
							<div class="table-selector-container" style="min-height: 100px;">
								<table class="table-selector" style="width: 350px;">
									<tbody>
										<?php $array = $tpl->Get('surveys'); if(is_array($array) || is_object($array)): foreach($array as $k=>$form): $tpl->Assign('k', $k, false); $tpl->Assign('form', $form, false);  ?>
											<tr>
												<td><input <?php if($tpl->Get('form','responseCount') == 0): ?>class="no-responses"<?php endif; ?> type="radio" name="surveyId" value="<?php echo $tpl->Get('form','id'); ?>" /></td>
												<td><?php echo $tpl->Get('form','name'); ?></td>
												<td>
													<?php echo $tpl->Get('form','responseCount'); ?>
													<?php if($tpl->Get('form','responseCount') == 1): ?>
														<?php echo GetLang('Addon_Surveys_responseSingular'); ?>
													<?php else: ?>
														<?php echo GetLang('Addon_Surveys_responsePlural'); ?>
													<?php endif; ?>
												</td>
											</tr>
										 <?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</li>
					<li>
						<label></label>
						<div style="margin-left: 172px">
							<button class="Field" type="submit"><?php echo GetLang('Addon_Surveys_ResultsViewResults'); ?></button>
							<button class="cancel Field" type="button"><?php echo GetLang('Addon_Surveys_exportResponsesCancel'); ?></button>
						</div>
					</li>
				</ul>
		</form>
	<?php else: ?>
		<div id="no-forms-message"></div>
		<table cellspacing="0" cellpadding="0" width="100%" align="center">
		<tr>
			<td class="body">
				<div style='background-color:#FFF1A8; padding:5px 5px 8px 10px; margin-bottom:10px'>
					<img src='images/info.gif' width='18' height='18' align='left' style='padding-right:4px; margin-top:-2px' /><?php echo GetLang('Addon_Surveys_NoResults'); ?>
				</div>
			</td>
		</tr>
		<tr><td class="body"><input type="submit" name="Action" value="<?php print GetLang('Addon_surveys_Create'); ?>" class="Field" onclick="location.href='index.php?Page=Addons&Addon=surveys&&Action=Create';return false;"></td></tr>
	</table>
	<?php endif; ?>
