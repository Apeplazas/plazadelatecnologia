<?php $IEM = $tpl->Get('IEM'); ?><script>
	var PAGE = {
		init: function() {
				Application.Ui.CheckboxSelection(
					'table#SplittestManageList',
					'input.UICheckboxToggleSelector',
					'input.UICheckboxToggleRows'
				);

			$('#DeleteSplitTestButton').click(function() {
				PAGE.deleteSelected();
			});

		},

		deleteSelected: function() {
			var selected = 	$('.splitTestSelection').filter(function() { return this.checked; });

			if (selected.length < 1) {
				alert("<?php echo GetLang('Addon_splittest_Delete_SelectFirst'); ?>");
				return false;
			}

			if (!confirm("<?php echo GetLang('Addon_splittest_Delete_ConfirmMessage'); ?>")) {
				return;
			}

			var selectedIds = [];
			for(var i = 0, j = selected.length; i < j; ++i) {
				selectedIds.push(selected[i].value);
			}

			Application.Util.submitPost('<?php echo $tpl->Get('AdminUrl'); ?>&Action=Delete', {splitids: selectedIds});
		}
	};

	$(function() {
		PAGE.init();
	});

	function DelSplitTest(id, status)
	{
		if (id < 1) {
			return false;
		}

		if (status == 'i' || status == 'r') {
			alert('<?php echo GetLang('Addon_splittest_Manage_Delete_Disabled_Alert'); ?>');
			return false;
		}

		if (!confirm('<?php echo GetLang('Addon_splittest_DeleteOne_Confirm'); ?>')) {
			return false;
		}

		Application.Util.submitPost('<?php echo $tpl->Get('AdminUrl'); ?>&Action=Delete', {splitid: id});
		return true;
	}
</script>
<table width="100%" border="0">
	<tr>
		<td class="Heading1" colspan="2"><?php echo GetLang('Addon_splittest_Heading'); ?></td>
	</tr>
	<tr>
		<td class="body pageinfo" colspan="2"><p><?php echo GetLang('Addon_splittest_Intro'); ?></p></td>
	</tr>
	<tr>
		<td colspan="2">
			<?php echo $tpl->Get('FlashMessages'); ?>
		</td>
	</tr>
	<tr>
		<td class="body" colspan="2">
			<?php echo $tpl->Get('SplitTest_Create_Button'); ?>
			<?php if($tpl->Get('ShowDeleteButton')): ?>
				<input class="SmallButton" type="button" style="width: 150px;" value="<?php echo GetLang('Addon_splittest_DeleteButton'); ?>" name="DeleteSplitTestButton" id="DeleteSplitTestButton"/>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td valign="bottom">
			&nbsp;
		</td>
		<td align="right">
			<div align="right">
				<?php echo $tpl->Get('Paging'); ?>
			</div>
		</td>
	</tr>
</table>
<form name="splittestlist" id="splittestlist">
<table class="Text" width="100%" cellspacing="0" cellpadding="0" border="0" id="SplittestManageList">
	<tr class="Heading3">
		<td width="1" align="center">
			<input class="UICheckboxToggleSelector" type="checkbox" name="toggle"/>
		</td>
		<td width="5">&nbsp;</td>
		<td width="20%" nowrap="nowrap">
			<?php echo GetLang('Addon_splittest_Manage_SplitName'); ?>
			<a href="<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=splitname&Direction=asc"><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"/></a>
			<a href="<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=splitname&Direction=desc"><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"/></a>
		</td>
		<td width="*" nowrap="nowrap">
			<?php echo GetLang('Addon_splittest_Manage_SplitCampaigns'); ?>
		</td>
		<td width="10%" nowrap="nowrap">
			<?php echo GetLang('Addon_splittest_Manage_SplitType'); ?>
			<a href="<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=splittype&Direction=asc"><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"/></a>
			<a href="<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=splittype&Direction=desc"><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"/></a>
		</td>
		<td width="10%" nowrap="nowrap">
			<?php echo GetLang('Addon_splittest_Manage_SplitCreated'); ?>
			<a href="<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=createdate&Direction=asc"><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"/></a>
			<a href="<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=createdate&Direction=desc"><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"/></a>
		</td>
		<td width="10%" nowrap="nowrap">
			<?php echo GetLang('Addon_splittest_Manage_SplitLastSent'); ?>
			<a href="<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=lastsent&Direction=asc"><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"/></a>
			<a href="<?php echo $tpl->Get('AdminUrl'); ?>&SortBy=lastsent&Direction=desc"><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"/></a>
		</td>
		<td width="180" nowrap="nowrap">
			<?php echo GetLang('Addon_splittest_Manage_SplitAction'); ?>
		</td>
	</tr>
	<?php $array = $tpl->Get('splitTests'); if(is_array($array) || is_object($array)): foreach($array as $k=>$splittestEntry): $tpl->Assign('k', $k, false); $tpl->Assign('splittestEntry', $splittestEntry, false);  ?>
		<tr class="GridRow" id="<?php echo $tpl->Get('splittestEntry','splitid'); ?>">
			<td width="1">
				<input class="UICheckboxToggleRows splitTestSelection" type="checkbox" name="splitids[]" value="<?php echo $tpl->Get('splittestEntry','splitid'); ?>">
			</td>
			<td>
					<img src="<?php echo $tpl->Get('ApplicationUrl'); ?>/addons/splittest/images/m_splittests.gif" border="0"/>
			</td>
			<td>
				<?php echo $tpl->Get('splittestEntry','splitname'); ?>
			</td>
			<td>
				<?php echo $tpl->Get('splittestEntry','campaign_names'); ?>
			</td>
			<td>
				<span class="HelpText" onMouseOut="HideHelp('splitDisplay<?php echo $tpl->Get('splittestEntry','splitid'); ?>');" onMouseOver="ShowQuickHelp('splitDisplay<?php echo $tpl->Get('splittestEntry','splitid'); ?>', '<?php echo $tpl->Get('splittestEntry','tipheading'); ?>', '<?php echo $tpl->Get('splittestEntry','tipdetails'); ?>');">
				<?php if($tpl->Get('splittestEntry','splittype') == 'distributed'): ?>
					<?php echo GetLang('Addon_splittest_Manage_SplitType_Distributed'); ?>
				<?php elseif($tpl->Get('splittestEntry','splittype') == 'percentage'): ?>
					<?php echo GetLang('Addon_splittest_Manage_SplitType_Percentage'); ?>
				<?php endif; ?>
				</span><br /><div id="splitDisplay<?php echo $tpl->Get('splittestEntry','splitid'); ?>" style="display: none;"></div>
			</td>
			<td>
				<?php echo dateformat($tpl->Get('splittestEntry','createdate'), $tpl->Get('DateFormat')); ?>
			</td>
			<td>
				<?php if($tpl->Get('splittestEntry','lastsent') == 0): ?>
					<?php echo GetLang('Addon_splittest_Manage_LastSent_Never'); ?>
				<?php else: ?>
					<?php echo dateformat($tpl->Get('splittestEntry','lastsent'), $tpl->Get('DateFormat')); ?>
				<?php endif; ?>
			</td>
			<td>
				<?php if($tpl->Get('SendPermission')): ?>
					<?php if($tpl->Get('splittestEntry','jobstatus') == 'i'): ?>
						<a href="<?php echo $tpl->Get('AdminUrl'); ?>&Action=Send&id=<?php echo $tpl->Get('splittestEntry','splitid'); ?>&Step=20"><?php echo GetLang('Addon_splittest_Pause'); ?></a>
					<?php elseif($tpl->Get('splittestEntry','jobstatus') == 'p'): ?>
						<a href="<?php echo $tpl->Get('AdminUrl'); ?>&Action=Send&id=<?php echo $tpl->Get('splittestEntry','splitid'); ?>&Step=30"><?php echo GetLang('Addon_splittest_Resume'); ?></a>
					<?php elseif($tpl->Get('splittestEntry','jobstatus') == 'w'): ?>
						<?php if($tpl->Get('ScheduleSendPermission')): ?>
							<a href="<?php echo $tpl->Get('ApplicationUrl'); ?>index.php?Page=Schedule"><?php echo GetLang('Addon_splittest_WaitingToSend'); ?></a>
						<?php else: ?>
							<a href="<?php echo $tpl->Get('AdminUrl'); ?>&Action=Send&id=<?php echo $tpl->Get('splittestEntry','splitid'); ?>&Step=20"><?php echo GetLang('Addon_splittest_WaitingToSend'); ?></a>
						<?php endif; ?>
					<?php elseif($tpl->Get('splittestEntry','jobstatus') == 't'): ?>
						<span class="HelpText" onMouseOut="HideHelp('splitDisplayTimeout<?php echo $tpl->Get('splittestEntry','splitid'); ?>');"
						onMouseOver="ShowQuickHelp('splitDisplayTimeout<?php echo $tpl->Get('splittestEntry','splitid'); ?>', '<?php echo $tpl->Get('splittestEntry','TimeoutTipHeading'); ?>', '<?php echo $tpl->Get('splittestEntry','TimeoutTipDetails'); ?>');">
							<?php if($tpl->Get('ScheduleSendPermission')): ?>
								<?php echo GetLang('Addon_splittest_TimeoutMode'); ?>
							<?php else: ?>
								<a href="<?php echo $tpl->Get('AdminUrl'); ?>&Action=Send&id=<?php echo $tpl->Get('splittestEntry','splitid'); ?>&Step=20"><?php echo GetLang('Addon_splittest_TimeoutMode'); ?></a>
							<?php endif; ?>
						</span><div id="splitDisplayTimeout<?php echo $tpl->Get('splittestEntry','splitid'); ?>" style="display: none;"></div>
					<?php else: ?>
						<a href="<?php echo $tpl->Get('AdminUrl'); ?>&Action=Send&id=<?php echo $tpl->Get('splittestEntry','splitid'); ?>"><?php echo GetLang('Addon_splittest_Manage_Send'); ?></a>
					<?php endif; ?>
				<?php endif; ?>
				<?php if($tpl->Get('EditPermission')): ?>
					<?php if($tpl->Get('splittestEntry','jobstatus') == 'i' || $tpl->Get('splittestEntry','jobstatus') == 'r'): ?>
						&nbsp;<a href="#" onClick="alert('<?php echo GetLang('Addon_splittest_Manage_Edit_Disabled_Alert'); ?>'); return false;" title="<?php echo GetLang('Addon_splittest_Manage_Edit_Disabled'); ?>"><?php echo GetLang('Addon_splittest_Manage_Edit'); ?></a>
					<?php else: ?>
						&nbsp;<a href="<?php echo $tpl->Get('AdminUrl'); ?>&Action=Edit&id=<?php echo $tpl->Get('splittestEntry','splitid'); ?>"><?php echo GetLang('Addon_splittest_Manage_Edit'); ?></a>
					<?php endif; ?>
				<?php endif; ?>
				<?php if($tpl->Get('CopyPermission')): ?>
					&nbsp;<a href="<?php echo $tpl->Get('AdminUrl'); ?>&Action=Create&Copy=<?php echo $tpl->Get('splittestEntry','splitid'); ?>"><?php echo GetLang('Addon_splittest_Manage_Copy'); ?></a>
				<?php endif; ?>
				<?php if($tpl->Get('DeletePermission')): ?>
					&nbsp;<a href="#" <?php if($tpl->Get('splittestEntry','jobstatus') == 'i' || $tpl->Get('splittestEntry','jobstatus') == 'r'): ?> title="<?php echo GetLang('Addon_splittest_Manage_Delete_Disabled'); ?>"<?php endif; ?> onClick="return DelSplitTest(<?php echo $tpl->Get('splittestEntry','splitid'); ?>, '<?php echo $tpl->Get('splittestEntry','jobstatus'); ?>');"><?php echo GetLang('Addon_splittest_Manage_Delete'); ?></a>
				<?php endif; ?>
				&nbsp;
			</td>
		</tr>
	 <?php endforeach; endif; ?>
</table>
</form>
