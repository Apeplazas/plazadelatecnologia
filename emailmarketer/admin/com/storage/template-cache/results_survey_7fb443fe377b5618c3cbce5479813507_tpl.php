<?php $IEM = $tpl->Get('IEM'); ?><link rel="stylesheet" type="text/css" href="addons/surveys/styles/tableselector.css" />
<link rel="stylesheet" type="text/css" href="addons/surveys/styles/view.response.css" />
<link rel="stylesheet" type="text/css" href="addons/surveys/styles/survey_result.css" />

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

<div class="BodyContainer">
	<?php if($tpl->Get('responseCount')): ?>
		<h2 class="PageTitle"><?php echo sprintf(GetLang('Addon_Surveys_resultsResponseTitle'), $tpl->Get('survey_name')); ?></h2>
	<?php else: ?>
		<h2 class="PageTitle"><?php echo sprintf(GetLang('Addon_Surveys_resultsResponseTitleNoResponses'), $tpl->Get('form','name')); ?></h2>
	<?php endif; ?>
	<div class="PageDescription"><?php echo GetLang('Addon_Surveys_resultsResponseDescription'); ?></div>
	<form id="form-responses" action="index.php?Page=Addons&Addon=surveys&Action=export&ajax=1" method="post">
		<div class="Buttons">
			<input type="hidden" id="survey_id" value=<?php echo $tpl->Get('survey_id'); ?>" />
			<button class="export Field" type="button"><?php echo GetLang('Addon_Surveys_Results_exportResponses'); ?></button>
			<button class="browse Field" type="button"><?php echo GetLang('Addon_Surveys_Results_browseResponse'); ?></button>
		</div>
	</form>
	<?php if($tpl->Get('responseCount')): ?>
	<dl class="widgets">	
		<?php $array = $tpl->Get('survey_results'); if(is_array($array) || is_object($array)): foreach($array as $__key=>$each_result): $tpl->Assign('__key', $__key, false); $tpl->Assign('each_result', $each_result, false);  ?>
			<?php echo $tpl->Get('each_result'); ?>
		 <?php endforeach; endif; ?>
	</dl>
	<?php endif; ?>		
</div>	