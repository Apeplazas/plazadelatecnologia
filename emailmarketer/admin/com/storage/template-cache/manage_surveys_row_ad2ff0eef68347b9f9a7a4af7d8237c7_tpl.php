<?php $IEM = $tpl->Get('IEM'); ?><tr class="GridRow">
	<td width="5" nowrap align="center">
		<input type="checkbox" name="survey_select[]" value="<?php echo $tpl->Get('surveyid'); ?>" />
	</td>
	<td><img src="images/mnu_surveys_button.gif" border=0></td>
	<td nowrap="nowrap">
		<?php echo $tpl->Get('name'); ?>
	</td>
	<td nowrap="nowrap">
		<?php echo $tpl->Get('created'); ?>
	</td>
	<td nowrap="nowrap">
		<?php echo $tpl->Get('updated'); ?>
	</td>
	<td nowrap="nowrap">
		<?php echo $tpl->Get('numresponses'); ?>
	</td>	
	<td nowrap="nowrap">
			<?php echo $tpl->Get('preview_link'); ?>&nbsp;&nbsp;<?php echo $tpl->Get('view_results'); ?>&nbsp;&nbsp;<?php echo $tpl->Get('export_responses'); ?>&nbsp;&nbsp;<?php echo $tpl->Get('edit_link'); ?>&nbsp;&nbsp;<?php echo $tpl->Get('delete_link'); ?>
	</td>
</tr>
