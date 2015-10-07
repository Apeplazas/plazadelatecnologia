<?php $IEM = $tpl->Get('IEM'); ?><li id="<?php echo $tpl->Get('randomId'); ?>" class="form-element {type: 'textarea'}">
	<input type="hidden" name="widget[<?php echo $tpl->Get('randomId'); ?>][id]" value="<?php echo $tpl->Get('widget','id'); ?>" />
	<input type="hidden" name="widget[<?php echo $tpl->Get('randomId'); ?>][type]" value="textarea" />
	<input type="hidden" name="widget[<?php echo $tpl->Get('randomId'); ?>][field][0][id]" value="<?php echo $tpl->Get('widgetFields','0','id'); ?>" />
	
	<div class="ui-draggable-handle">
		<div class="form-element-title">
			<span class="form-element-required">*</span>
			<span class="title"><input class="edit-in-place example-field strong" type="text" name="widget[<?php echo $tpl->Get('randomId'); ?>][name]" value="<?php echo $tpl->Get('widget','name'); ?>" title="<?php echo GetLang('Addon_Surveys_WidgetTextareaDefaultName'); ?>" /></span>
			<a class="form-element-minimize" href="#" title="<?php echo GetLang('Addon_Surveys_WidgetToggleTitle'); ?>"><?php echo GetLang('Addon_Surveys_WidgetTextareaToggle'); ?></a>
			<a class="form-element-duplicate" href="#" title="<?php echo GetLang('Addon_Surveys_WidgetDuplicateTitle'); ?>"><?php echo GetLang('Addon_Surveys_WidgetTextareaDuplicate'); ?></a>
			<a class="form-element-remove" href="#" title="<?php echo GetLang('Addon_Surveys_WidgetRemoveTitle'); ?>"><?php echo GetLang('Addon_Surveys_WidgetRemove'); ?></a>
		</div>
	</div>
	
	<div class="form-element-content">
		<input class="edit-in-place example-field em light" type="text" name="widget[<?php echo $tpl->Get('randomId'); ?>][description]" value="<?php echo $tpl->Get('widget','description'); ?>" title="<?php echo GetLang('Addon_Surveys_WidgetTextareaDefaultDescription'); ?>" />
		
		<ul>
			<li><textarea disabled="disabled"><?php echo GetLang('Addon_Surveys_WidgetTextareaValueText'); ?></textarea></li>
		</ul>
		
		<div class="form-element-options">
			<ul class="inline">
				<li>
					<input id="is-required-<?php echo $tpl->Get('randomId'); ?>" type="checkbox" name="widget[<?php echo $tpl->Get('randomId'); ?>][is_required]" value="1" <?php if($tpl->Get('widget','is_required')): ?>checked="checked"<?php endif; ?> />
					<label for="is-required-<?php echo $tpl->Get('randomId'); ?>"><?php echo GetLang('Addon_Surveys_WidgetTextareaOptionRequiresAnAnswer'); ?></label>
				</li>
				<li>
					<select name="widget[<?php echo $tpl->Get('randomId'); ?>][is_visible]">
						<option value="1" <?php if($tpl->Get('widget','is_visible') == '1'): ?>selected="selected"<?php endif; ?>><?php echo GetLang('Addon_Surveys_WidgetTextareaOptionVisibleToEveryone'); ?></option>
						<option value="0" <?php if($tpl->Get('widget','is_visible') == '0'): ?>selected="selected"<?php endif; ?>><?php echo GetLang('Addon_Surveys_WidgetTextareaOptionVisibleToAdministrators'); ?></option>
					</select>
					<img class="tooltip" src="images/help.gif" alt="<?php echo GetLang('Addon_Surveys_WidgetTextareaTooltipTitleVisibility'); ?>" title="<?php echo GetLang('Addon_Surveys_WidgetTextareaTooltipDescriptionVisibility'); ?>" />
				</li>
				<li class="clear"></li>
			</ul>
		</div>
	</div>
</li>
