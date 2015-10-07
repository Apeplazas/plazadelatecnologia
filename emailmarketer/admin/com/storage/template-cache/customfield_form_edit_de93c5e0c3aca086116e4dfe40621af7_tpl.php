<?php $IEM = $tpl->Get('IEM'); ?><script>
	Application.Page.CustomFieldEdit = {
		onFormSubmitFunction: {},

		eventDOMReady: function(event) {
			$(document.cfForm).submit(Application.Page.CustomFieldEdit.eventFormSubmit);
			$('.CancelButton', document.cfForm).click(Application.Page.CustomFieldEdit.eventFormCancel);
		},

		eventFormSubmit: function(event) {
			for(var i in Application.Page.CustomFieldEdit.onFormSubmitFunction) {
				try {
					if(!Application.Page.CustomFieldEdit.onFormSubmitFunction[i]()) {
						event.stopPropagation();
						event.preventDefault();
						return false;
					}
				} catch(e) { }
			}

			// This function is called more than once so it's in javascript.js
			if(!ValidateCustomFieldForm('<?php print GetLang('CustomField_NoFieldName'); ?>', '<?php print GetLang('CustomField_NoDefaultValue'); ?>', '<?php print GetLang('CustomFields_NoMultiValues'); ?>')) {
				event.stopPropagation();
				event.preventDefault();
				return false;
			}
		},

		eventFormCancel: function(event) {
 			if(confirm("<?php if(isset($GLOBALS['CancelButton'])) print $GLOBALS['CancelButton']; ?>")) document.location="index.php?Page=CustomFields";
		}
	};

	Application.init.push(Application.Page.CustomFieldEdit.eventDOMReady);
</script>
<form name="cfForm" method="post" id="cfForm" action="index.php?Page=CustomFields&Action=<?php if(isset($GLOBALS['Action'])) print $GLOBALS['Action']; ?>">
	<table cellspacing="0" cellpadding="0" width="100%" align="center">
		<tr>
			<td class="Heading1">
				<?php if(isset($GLOBALS['Heading'])) print $GLOBALS['Heading']; ?>
			</td>
		</tr>
		<tr>
			<td class="body pageinfo">
				<p>
					<?php if(isset($GLOBALS['Intro'])) print $GLOBALS['Intro']; ?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<?php if(isset($GLOBALS['Message'])) print $GLOBALS['Message']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<input class="FormButton" type="submit" value="<?php print GetLang('Next'); ?>" />
				<input class="FormButton CancelButton" type="button" value="<?php print GetLang('Cancel'); ?>" />
				<br />
				&nbsp;
				<table border="0" cellspacing="0" cellpadding="2" width="100%" class="Panel" id="customFieldsTable">
					<tr>
						<td colspan="2" class="Heading2">
							&nbsp;&nbsp;<?php if(isset($GLOBALS['CustomFieldDetails'])) print $GLOBALS['CustomFieldDetails']; ?>
						</td>
					</tr>
					<tr>
						<td class="FieldLabel">
							<?php $tmpTplFile = $tpl->GetTemplate();
			$tmpTplData = $tpl->TemplateData;
			$tpl->ParseTemplate("Required");
			$tpl->SetTemplate($tmpTplFile);
			$tpl->TemplateData = $tmpTplData; ?>
							<?php print GetLang('CustomFieldName'); ?>:&nbsp;
						</td>
						<td>
							<input type="text" name="FieldName" id="FieldName" class="Field250" value="<?php if(isset($GLOBALS['FieldName'])) print $GLOBALS['FieldName']; ?>">&nbsp;<span class="HelpToolTip"><img src="images/help.gif" alt="?" width="24" height="16" border="0" /><span class="HelpToolTip_Title" style="display:none;"><?php print stripslashes(GetLang('CustomFieldName')); ?></span><span class="HelpToolTip_Contents" style="display:none;"><?php print stripslashes(GetLang('HLP_CustomFieldName')); ?></span></span>
						</td>
					</tr>
					<tr>
						<td class="FieldLabel">
							<?php $tmpTplFile = $tpl->GetTemplate();
			$tmpTplData = $tpl->TemplateData;
			$tpl->ParseTemplate("Not_Required");
			$tpl->SetTemplate($tmpTplFile);
			$tpl->TemplateData = $tmpTplData; ?>
							<?php print GetLang('CustomFieldRequired'); ?>&nbsp;
						</td>
						<td>
							<label for="FieldRequired"><input type="checkbox" id="FieldRequired" name="FieldRequired"<?php if(isset($GLOBALS['FieldRequired'])) print $GLOBALS['FieldRequired']; ?>><?php print GetLang('CustomFieldRequiredExplain'); ?></label>
						</td>
					</tr>
					<?php if(isset($GLOBALS['SubForm'])) print $GLOBALS['SubForm']; ?>
				</table>
				<table width="100%" cellspacing="0" cellpadding="2" border="0" class="PanelPlain">
					<tr>
						<td width="200" class="FieldLabel"></td>
						<td>
							<input class="FormButton" type="submit" value="<?php print GetLang('Next'); ?>" />
							<input class="FormButton CancelButton" type="button" value="<?php print GetLang('Cancel'); ?>" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
