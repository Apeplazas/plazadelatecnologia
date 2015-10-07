<?php $IEM = $tpl->Get('IEM'); ?><script>
$(document).ready(function() {
	$('#toggleCheck').click(function() {
		if ($('#toggleCheck')[0].checked) {
			$('input[type="checkbox"]').attr('checked','checked');
		} else {
			$('input[type="checkbox"]').attr('checked','');
		}
	});
	
	$('a.deleteButton').click(function() {
		var con = confirm("<?php echo GetLang('Addon_survey_Confirm_Delete_Multi'); ?>");
		if (!con) {
			return false;	
		}
	});

	$('#deleteButton').click(function() {
		var selected = 	$('input[name="survey_select[]"]').filter(function() { return this.checked; });

		if (selected.length < 1) {
			alert("<?php echo GetLang('Addon_surveys_SurveyDeleted_PleaseSelect'); ?>");
			return false;
		}
	
		var con = confirm("<?php echo GetLang('Addon_survey_Confirm_Delete_Multi'); ?>");
		if (con) {				
			document.manageSurvey.action = 'index.php?Page=Addons&Addon=surveys&Action=Delete'; 
			$(document.manageSurvey).submit();
		}
	});
	
	
});

</script>
<form action="<?php echo $tpl->Get('AdminUrl'); ?>" name="manageSurvey" method="post">
	<table cellspacing="0" cellpadding="0" width="100%" align="center">
	<tr>
		<td class="Heading1"><?php print GetLang('Addon_surveys_Manage'); ?></td>
	</tr>
		<tr>
			<td class="body pageinfo">
				<p>
					<?php print GetLang('Addon_surveys_ManageIntro'); ?>
				</p>
			</td>
		</tr>
	<tr>
		<td>
			<?php echo $tpl->Get('FlashMessages'); ?>
		</td>
	</tr>
	<tr>
		<td class="body">
			<table width="100%" border="0">
				<tr>
					<td>
						<div style="padding-top:10px; padding-bottom:10px">
							<?php echo $tpl->Get('Add_Button'); ?> 
							<?php echo $tpl->Get('Delete_Button'); ?>
						</div>
						
					</td>
					<td align="right" valign="bottom">
						<?php echo $tpl->Get('Paging'); ?>
					</td>
				</tr>
			</table>
			<table border=0 cellspacing="0" cellpadding="0" width=100% class="Text">
				<tr class="Heading3">
					<td width="5" nowrap align="center">
						<input type="checkbox" id="toggleCheck" class="UICheckboxToggleSelector" />
					</td>
					<td width="5">&nbsp;</td>
					<td width="20%" nowrap="nowrap">
						<?php print GetLang('Addon_Surveys_Default_TableHead_Name'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=Name&Direction=Up'><img src="images/sortup.gif" border=0></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=Name&Direction=Down'><img src="images/sortdown.gif" border=0></a>
					</td>
					<td width="20%" nowrap="nowrap">
						<?php print GetLang('Addon_Surveys_Default_TableHead_Created'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=Created&Direction=Up'><img src="images/sortup.gif" border=0></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=Created&Direction=Down'><img src="images/sortdown.gif" border=0></a>
					</td>
					<td width="20%" nowrap="nowrap">
						<?php print GetLang('Addon_Surveys_Default_TableHead_Updated'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=Updated&Direction=Up'><img src="images/sortup.gif" border=0></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=Updated&Direction=Down'><img src="images/sortdown.gif" border=0></a>
					</td>
					<td width="20%" nowrap="nowrap">
						<?php print GetLang('Addon_Surveys_Default_TableHead_Responses'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=ResponseCount&Direction=Up'><img src="images/sortup.gif" border=0></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=ResponseCount&Direction=Down'><img src="images/sortdown.gif" border=0></a>
					</td>
					<td width="150">
						<?php print GetLang('Action'); ?>
					</td>
				</tr>
				<?php echo $tpl->Get('Items'); ?>
			</table>
			
		</td>
	</tr>
</table>
</form>