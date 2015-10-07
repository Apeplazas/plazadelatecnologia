<?php $IEM = $tpl->Get('IEM'); ?><script type="text/javascript">

	// the radio widget takes some logic from the checkbox js
	jFrame.getInstance('moduleForm').dispatch(['widget.checkbox', 'widget.radio'], {
			context : '#<?php echo $tpl->Get('randomId'); ?>'
		});

</script>

<li id="<?php echo $tpl->Get('randomId'); ?>" class="form-element {type: 'radio'}">
	<input type="hidden" name="widget[<?php echo $tpl->Get('randomId'); ?>][id]" value="<?php echo $tpl->Get('widget','id'); ?>" />
	<input type="hidden" name="widget[<?php echo $tpl->Get('randomId'); ?>][type]" value="radio" />
	
	<div class="ui-draggable-handle">
		<div class="form-element-title">
			<span class="form-element-required">*</span>
			<span class="title"><input class="edit-in-place example-field strong" type="text" name="widget[<?php echo $tpl->Get('randomId'); ?>][name]" value="<?php echo $tpl->Get('widget','name'); ?>" title="<?php echo GetLang('Addon_Surveys_WidgetRadioDefaultName'); ?>" /></span>
			<a class="form-element-minimize" href="#" title="<?php echo GetLang('Addon_Surveys_WidgetToggleTitle'); ?>"><?php echo GetLang('Addon_Surveys_WidgetTextToggle'); ?></a>
			<a class="form-element-duplicate" href="#" title="<?php echo GetLang('Addon_Surveys_WidgetDuplicateTitle'); ?>"><?php echo GetLang('Addon_Surveys_WidgetTextDuplicate'); ?></a>
			<a class="form-element-remove" href="#" title="<?php echo GetLang('Addon_Surveys_WidgetRemoveTitle'); ?>"><?php echo GetLang('Addon_Surveys_WidgetRemove'); ?></a>
		</div>
	</div>
	
	<div class="form-element-content">
		<input class="edit-in-place example-field em light" type="text" name="widget[<?php echo $tpl->Get('randomId'); ?>][description]" value="<?php echo $tpl->Get('widget','description'); ?>" title="<?php echo GetLang('Addon_Surveys_WidgetRadioDefaultDescription'); ?>" />
		
		<ul>
			<li style="max-height: 250px; overflow: auto;">
				<table style="margin: 5px 0; padding: 0; border-collapse: collapse; border: 0;">
					<tbody class="form-element-option-list">
						<?php $array = $tpl->Get('widgetFields'); if(is_array($array) || is_object($array)): foreach($array as $fieldIndex=>$widgetField): $tpl->Assign('fieldIndex', $fieldIndex, false); $tpl->Assign('widgetField', $widgetField, false);  ?>
							<tr>
								<td style="vertical-align: top">
									<input type="hidden" name="widget[<?php echo $tpl->Get('randomId'); ?>][field][<?php echo $tpl->Get('fieldIndex'); ?>][id]" value="<?php echo $tpl->Get('widgetField','id'); ?>" />
									<input id="selected-<?php echo $tpl->Get('fieldIndex'); ?>-<?php echo $tpl->Get('randomId'); ?>" type="radio" name="widget[<?php echo $tpl->Get('randomId'); ?>][field][<?php echo $tpl->Get('fieldIndex'); ?>][is_selected]" value="1" <?php if($tpl->Get('widgetField','is_selected')): ?>checked="checked"<?php endif; ?> />
								</td>
								<td><input id="label-$fieldIndex-<?php echo $tpl->Get('randomId'); ?>" class="edit-in-place example-field" type="text" name="widget[<?php echo $tpl->Get('randomId'); ?>][field][<?php echo $tpl->Get('fieldIndex'); ?>][value]" value="<?php echo $tpl->Get('widgetField','value'); ?>" title="<?php echo GetLang('Addon_Surveys_WidgetValueField'); ?>1" /></td>
								<td><a class="add-option-to-list" href="#"></a></td>
								<td><a class="remove-option-from-list" href="#" <?php if($tpl->Get('fieldIndex') == 0): ?>style="display: none;"<?php endif; ?> ></a></td>
								<td>
									<span class="add-other-container" style="display: none;">
									<?php echo GetLang('Addon_Surveys_WidgetTextOr'); ?>
									<a class="add-other" href="#"><?php echo GetLang('Addon_Surveys_WidgetTextAddOther'); ?></a></span>
								</td>
							</tr>
						 <?php endforeach; endif; ?>
						
						<tr class="other-row" <?php if(!$tpl->Get('widgetFieldOther')): ?>style="display: none;"<?php endif; ?> >
							<td style="vertical-align: top">
								<input type="hidden" name="widget[<?php echo $tpl->Get('randomId'); ?>][field][other][id]" value="<?php echo $tpl->Get('widgetFieldOther','id'); ?>" />
								<input type="hidden" name="widget[<?php echo $tpl->Get('randomId'); ?>][field][other][is_other]" value="1" />
								<input type="radio" name="widget[<?php echo $tpl->Get('randomId'); ?>][field][other][is_selected]" value="1" <?php if($tpl->Get('widgetFieldOther','is_selected')): ?>checked="checked"<?php endif; ?> />
							</td>
							<td>
								<div>
									<input class="edit-in-place example-field" 
										   type="text" 
										   name="widget[<?php echo $tpl->Get('randomId'); ?>][field][other][other_label_text]" 
										   value="<?php if($tpl->Get('widgetFieldOther')): ?><?php echo $tpl->Get('widgetFieldOther','other_label_text'); ?><?php else: ?><?php echo GetLang('Addon_Surveys_WidgetTextOther'); ?><?php endif; ?>"
										   title="<?php echo GetLang('Addon_Surveys_WidgetTextOther'); ?>"/>
								<div>
								<div>
									<label for="other-text-<?php echo $tpl->Get('randomId'); ?>"><img src="images/nodejoin.gif" alt=" - " /></label>
									<input id="other-text-<?php echo $tpl->Get('randomId'); ?>" type="text" value="<?php echo GetLang('Addon_Surveys_WidgetValueOther'); ?>" disabled="disabled" style="width: 227px;" />
								</div>
							</td>
							<td></td>
							<td style="vertical-align: top;"><a class="remove-other" href="#"></a><td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</li>
		</ul>
		
		<div class="form-element-options">
			<ul class="inline">
				<li>
					<input id="is-required-<?php echo $tpl->Get('randomId'); ?>" type="checkbox" name="widget[<?php echo $tpl->Get('randomId'); ?>][is_required]" value="1" <?php if($tpl->Get('widget','is_required')): ?>checked="checked"<?php endif; ?> />
					<label for="is-required-<?php echo $tpl->Get('randomId'); ?>"><?php echo GetLang('Addon_Surveys_WidgetRadioOptionRequiresAnAnswer'); ?></label>
				</li>
				<li>
					<input id="is-random-<?php echo $tpl->Get('randomId'); ?>" type="checkbox" name="widget[<?php echo $tpl->Get('randomId'); ?>][is_random]" value="1" <?php if($tpl->Get('widget','is_random')): ?>checked="checked"<?php endif; ?> />
					<label for="is-random-<?php echo $tpl->Get('randomId'); ?>"><?php echo GetLang('Addon_Surveys_WidgetRadioOptionRandomize'); ?></label>
					<img class="tooltip" src="images/help.gif" alt="<?php echo GetLang('Addon_Surveys_WidgetRadioTooltipTitleRandom'); ?>" title="<?php echo GetLang('Addon_Surveys_WidgetRadioTooltipDescriptionRandom'); ?>" />
				</li>
				<li>
					<select name="widget[<?php echo $tpl->Get('randomId'); ?>][is_visible]">
						<option value="1" <?php if($tpl->Get('widget','is_visible') == '1'): ?>selected="selected"<?php endif; ?>><?php echo GetLang('Addon_Surveys_WidgetRadioOptionVisibleToEveryone'); ?></option>
						<option value="0" <?php if($tpl->Get('widget','is_visible') == '0'): ?>selected="selected"<?php endif; ?>><?php echo GetLang('Addon_Surveys_WidgetRadioOptionVisibleToAdministrators'); ?></option>
					</select>
					<img class="tooltip" src="images/help.gif" alt="<?php echo GetLang('Addon_Surveys_WidgetRadioTooltipTitleVisibility'); ?>" title="<?php echo GetLang('Addon_Surveys_WidgetRadioTooltipDescriptionVisibility'); ?>" />
				</li>
				<li class="clear"></li>
			</ul>
		</div>
	</div>
</li>
