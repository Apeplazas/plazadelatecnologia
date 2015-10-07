<?php $IEM = $tpl->Get('IEM'); ?><script>
	var TabSize = 7;

	function PreparePreview(id) {
		var openurl = 'index.php?Page=Newsletters&Action=View&id=' + id;
		window.open(openurl, 'pp');
	}

	function ChangeLink(page,column,sort) {
		chooselink_id = document.getElementById('chooselink');
		selected = chooselink_id.selectedIndex;
		linkid = chooselink_id[selected].value;
		REMOTE_parameters = '&link=' + linkid;
		REMOTE_admin_table($('#statsTriggerEmails_OpenTable'),'<?php if(isset($GLOBALS['TableURL'])) print $GLOBALS['TableURL']; ?>','','<?php if(isset($GLOBALS['TableType'])) print $GLOBALS['TableType']; ?>','<?php if(isset($GLOBALS['TableToken'])) print $GLOBALS['TableToken']; ?>',page,column,sort);

		UpdateLinkSummary();
	}

	function ChangeBounceType() {}

	function UpdateLinkSummary() {
		/*
		if (document.getElementById('chooselink')) {
			chooselink_id = document.getElementById('chooselink');
			selected = chooselink_id.selectedIndex;
			linkid = chooselink_id[selected].value;
		} else {
			linkid = 'a';
		}

		// Update link stats
		$.get('remote_stats.php?Action=get_linkstats&link=' + linkid + '&token=<?php if(isset($GLOBALS['TableToken'])) print $GLOBALS['TableToken']; ?>','',
			function(data) {
				eval(data);
				$('#totalclicks').html(linksjson.linkclicks);
				$('#clickthrough').html(linksjson.clickthrough);
				$('#averageclicks').html(linksjson.averageclicks);
				$('#uniqueclicks').html(linksjson.uniqueclicks);
			}
		);*/
	}

	$(function() {
		if ($('#adminTabletriggeremails_opens').size() != 0) {
			REMOTE_admin_table($('#adminTabletriggeremails_opens'), '', '', 'triggeremails_opens', '<?php echo $tpl->Get('PAGE','session_token'); ?>', 1, 'opened', 'down');
		}

		if ($('#adminTabletriggeremails_links').size() != 0) {
			REMOTE_admin_table($('#adminTabletriggeremails_links'), '', '', 'triggeremails_links', '<?php echo $tpl->Get('PAGE','session_token'); ?>', 1, 'email', 'up');
		}

		if ($('#adminTabletriggeremails_bounces').size() != 0) {
			REMOTE_admin_table($('#adminTabletriggeremails_bounces'), '', '', 'triggeremails_bounces', '<?php echo $tpl->Get('PAGE','session_token'); ?>', 1, 'time', 'down');
		}

		if ($('#adminTabletriggeremails_unsubscribes').size() != 0) {
			REMOTE_admin_table($('#adminTabletriggeremails_unsubscribes'), '', '', 'triggeremails_unsubscribes', '<?php echo $tpl->Get('PAGE','session_token'); ?>', 1, 'time', 'down');
		}

		if ($('#adminTabletriggeremails_forwards').size() != 0) {
			REMOTE_admin_table($('#adminTabletriggeremails_forwards'), '', '', 'triggeremails_forwards', '<?php echo $tpl->Get('PAGE','session_token'); ?>', 1, 'email', 'up');
		}
	});
</script>
<div class="PageBodyContainer">
	<div class="Page_Header">
		<div class="Heading1"><?php echo GetLang('TriggerEmails_Stats_Title'); ?></div>
		<div class="Intro"><?php echo sprintf(GetLang('TriggerEamils_Stats_Page_Intro'), $tpl->Get('record','triggeremailsname')); ?></div>
	</div>

	
		<div style="display: block; clear: both;">
			<br>
			<ul id="tabnav">
				<li><a href="#" <?php if($tpl->Get('PAGE','whichtab') == 1): ?>class="active"<?php endif; ?> onClick="ShowTab(1); return false;" id="tab1"><?php echo GetLang('TriggerEmails_Stats_Tab_Snapshots'); ?></a></li>
				<li><a href="#" <?php if($tpl->Get('PAGE','whichtab') == 2): ?>class="active"<?php endif; ?> onClick="ShowTab(2); return false;" id="tab2"><?php echo GetLang('TriggerEmails_Stats_Tab_OpenStats'); ?></a></li>
				<li><a href="#" <?php if($tpl->Get('PAGE','whichtab') == 3): ?>class="active"<?php endif; ?> onClick="ShowTab(3); return false;" id="tab3"><?php echo GetLang('TriggerEmails_Stats_Tab_LinkStats'); ?></a></li>
				<li><a href="#" <?php if($tpl->Get('PAGE','whichtab') == 4): ?>class="active"<?php endif; ?> onClick="ShowTab(4); return false;" id="tab4"><?php echo GetLang('TriggerEmails_Stats_Tab_BounceStats'); ?></a></li>
				<li><a href="#" <?php if($tpl->Get('PAGE','whichtab') == 5): ?>class="active"<?php endif; ?> onClick="ShowTab(5); return false;" id="tab5"><?php echo GetLang('TriggerEmails_Stats_Tab_UnsubscribeStats'); ?></a></li>
				<li><a href="#" <?php if($tpl->Get('PAGE','whichtab') == 6): ?>class="active"<?php endif; ?> onClick="ShowTab(6); return false;" id="tab6"><?php echo GetLang('TriggerEmails_Stats_Tab_ForwardStats'); ?></a></li>
				<li><a href="#" <?php if($tpl->Get('PAGE','whichtab') == 7): ?>class="active"<?php endif; ?> onClick="ShowTab(7); return false;" id="tab7"><?php echo GetLang('TriggerEmails_Stats_Tab_SubscriberStats'); ?></a></li>
				<li><a href="#" <?php if($tpl->Get('PAGE','whichtab') == 8): ?>class="active"<?php endif; ?> onClick="ShowTab(8); return false;" id="tab8"><?php echo GetLang('TriggerEmails_Stats_Tab_FailedStats'); ?></a></li>
			</ul>
		</div>
	


	
		
			<div id="div1" style="display: <?php if($tpl->Get('PAGE','whichtab') == 1): ?>block<?php else: ?>none<?php endif; ?>; clear: both;">
				<div style="display: block; clear: both; padding-top:10px; padding-bottom:8px;"><?php echo $tpl->Get('tabs','snapshot','intro'); ?></div>
				<table width="100%" border="0" padding="0">
					<tr>
						<td width="45%" valign="top">
							<table border=0 width="100%" class="Text"  cellspacing="0">
								<tr class="Heading3">
									<td colspan="2" nowrap align="left">
										<?php echo GetLang('TriggerEmails_Stats_Snapshots_Heading'); ?>
									</td>
								</tr>
								<tr class="GridRow">
									<td width="30%" height="22" nowrap align="left" valign="top">
										&nbsp;<?php echo GetLang('NewsletterStatistics_SentTo'); ?>
									</td>
									<td width="70%" nowrap align="left">
										<?php echo $tpl->Get('record','processed_totalsent'); ?>
									</td>
								</tr>
								<tr class="GridRow">
									<td width="30%" height="22" nowrap align="left" valign="top">
										&nbsp;<?php echo GetLang('TriggerEmails_Stats_Snapshots_CreatedBy'); ?>
									</td>
									<td width="70%" nowrap align="left">
										<a href="mailto:<?php echo $tpl->Get('record','owneremail'); ?>"><?php if(trim($tpl->Get('record','ownername')) == ''): ?><?php echo $tpl->Get('record','ownerusername'); ?><?php else: ?><?php echo $tpl->Get('record','ownername'); ?><?php endif; ?></a>
									</td>
								</tr>
								<tr class="GridRow">
									<td width="30%" height="22" nowrap align="left" valign="top">
										&nbsp;<?php echo GetLang('NewsletterStatistics_Opened'); ?>
									</td>
									<td width="70%" nowrap align="left">
										<a	title="<?php echo GetLang('TriggerEmails_Stats_Snapshots_Tooltip_Open'); ?>" href="<?php echo $tpl->Get('tabs','snapshot','url_open_url'); ?>" <?php if(!$tpl->Get('PAGE','unique_open')): ?>onclick="ShowTab(2); return false;"<?php endif; ?>><?php echo $tpl->Get('tabs','snapshot','newsletter_totalopen'); ?></a>
										/
										<a title="<?php echo GetLang('TriggerEmails_Stats_Snapshots_Tooltip_UniqueOpen'); ?>" href="<?php echo $tpl->Get('tabs','snapshot','url_openunique_url'); ?>" <?php if($tpl->Get('PAGE','unique_open')): ?>onclick="ShowTab(2); return false;"<?php endif; ?>><?php echo $tpl->Get('tabs','snapshot','newsletter_uniqueopen'); ?></a>
									</td>
								</tr>
								<tr class="GridRow">
									<td width="30%" height="22" nowrap align="left" valign="top">
										&nbsp;<?php echo GetLang('NewsletterStatistics_Bounced'); ?>
									</td>
									<td width="70%" nowrap align="left">
										<?php echo $tpl->Get('tabs','snapshot','newsletter_bounce'); ?>
									</td>
								</tr>
							</table>
						</td>
						<td width="55%"><?php echo $tpl->Get('tabs','snapshot','summary_chart'); ?></td>
					</tr>
				</table>
			</div>
		

		
			<div id="div2" style="display: <?php if($tpl->Get('PAGE','whichtab') == 2): ?>block<?php else: ?>none<?php endif; ?>; clear: both;">
				<div class="body" style="display: block; clear: both; padding-top:10px; padding-bottom:8px;"><?php echo $tpl->Get('tabs','open','intro'); ?></div>
				<div style="padding-bottom: 10px;"><?php echo $tpl->Get('tabs','open','calendar'); ?></div>

				<?php if(!$tpl->Get('record','processed_timeframe_emailopens_total')): ?>
					<div><?php echo $tpl->Get('tabs','open','message'); ?></div>
				<?php else: ?>
					<table width="100%" border="0" class="Text">
						<tr>
							<td valign=top width="250" rowspan="2">
								<div class="MidHeading" style="width:100%"><img src="images/m_stats.gif" width="20" height="20" align="absMiddle">&nbsp;<?php echo GetLang('Opens_Summary'); ?></div>
								<ul class="Text">
									<li>
										<span class="HelpText" onmouseover="ShowHelp('total_open_explain', '<?php echo GetLang('TotalOpens'); ?>', '<?php echo GetLang('Stats_TotalOpens_Description'); ?>');" onmouseout="HideHelp('total_open_explain');"><?php echo GetLang('TotalOpens'); ?><?php echo $tpl->Get('tabs','open','email_opens_total'); ?></span>
										<div id="total_open_explain" style="display:none;"></div>
									</li>
									<li><?php echo GetLang('MostOpens'); ?><?php echo $tpl->Get('tabs','open','most_open_date'); ?></li>
									<li>
										<span class="HelpText" onmouseover="ShowHelp('total_uniqueopen_explain', '<?php echo GetLang('TotalUniqueOpens'); ?>', '<?php echo GetLang('Stats_TotalUniqueOpens_Description'); ?>');" onmouseout="HideHelp('total_uniqueopen_explain');"><?php echo GetLang('TotalUniqueOpens'); ?><?php echo $tpl->Get('tabs','open','email_opens_unique'); ?></span>
										<div id="total_uniqueopen_explain" style="display:none;"></div>
									</li>
									<li><?php echo GetLang('AverageOpens'); ?><?php echo $tpl->Get('tabs','open','average_opens'); ?></li>
									<li><?php echo GetLang('OpenRate'); ?><?php echo $tpl->Get('tabs','open','open_rate'); ?></li>
								</ul>
							</td>
							<td><?php echo $tpl->Get('tabs','open','open_chart'); ?></td>
						</tr>
					</table>

					<div id="adminTabletriggeremails_opens"></div>
				<?php endif; ?>
			</div>
		

		
			<div id="div3" style="display: <?php if($tpl->Get('PAGE','whichtab') == 3): ?>block<?php else: ?>none<?php endif; ?>; clear: both;">
				<div class="body" style="display: block; clear: both; padding-top:10px; padding-bottom:8px;"><?php echo $tpl->Get('tabs','links','intro'); ?></div>

				<div style="padding-bottom: 10px;"><?php echo $tpl->Get('tabs','links','calendar'); ?></div>

				<?php if(!$tpl->Get('record','processed_timeframe_linkclicks_total')): ?>
					<div><?php echo $tpl->Get('tabs','links','message'); ?></div>
				<?php else: ?>
					<table width="100%" border="0" class="Text">
						<tr>
							<td valign=top width="250" rowspan="2">
								<div class="MidHeading" style="width:100%"><img src="images/m_stats.gif" width="20" height="20" align="absMiddle">&nbsp;<?php echo GetLang('LinkClicks_Summary'); ?></div>
								<ul class="Text">
									<li><?php echo GetLang('Stats_TotalClicks'); ?>: <?php echo $tpl->Get('tabs','links','linkclicks_total'); ?></li>
									<li><?php echo GetLang('Stats_TotalUniqueClicks'); ?>: <?php echo $tpl->Get('tabs','links','linkclicks_individuals'); ?></li>
									<li><?php echo GetLang('Stats_UniqueClicks'); ?>: <?php echo $tpl->Get('tabs','links','linkclicks_unique'); ?></li>
									<li><?php echo GetLang('Stats_MostPopularLink'); ?>: <a href="<?php echo $tpl->Get('tabs','links','most_popular_link'); ?>" title="<?php echo $tpl->Get('tabs','links','most_popular_link'); ?>" target="_blank"><?php echo $tpl->Get('tabs','links','most_popular_link_short'); ?></a></li>
									<li><?php echo GetLang('Stats_AverageClicks'); ?>: <?php echo $tpl->Get('tabs','links','average_clicks'); ?></li>
									<li><?php echo GetLang('Stats_Clickthrough'); ?>: <?php echo $tpl->Get('tabs','links','click_through'); ?></li>
								</ul>
							</td>
							<td><?php echo $tpl->Get('tabs','links','link_chart'); ?></td>
						</tr>
					</table>

			        <div id="adminTabletriggeremails_links"></div>
				<?php endif; ?>
			</div>
		

		
			<div id="div4" style="display: <?php if($tpl->Get('PAGE','whichtab') == 4): ?>block<?php else: ?>none<?php endif; ?>; clear: both;">
				<div class="body" style="display: block; clear: both; padding-top:10px; padding-bottom:8px;"><?php echo $tpl->Get('tabs','bounces','intro'); ?></div>

				<div style="padding-bottom: 10px;"><?php echo $tpl->Get('tabs','bounces','calendar'); ?></div>

				<?php if(!$tpl->Get('record','processed_timeframe_bounces')): ?>
					<div><?php echo $tpl->Get('tabs','bounces','message'); ?></div>
				<?php else: ?>
					<table width="100%" border="0" class="Text">
						<tr>
							<td valign=top width="250" rowspan="2">
								<div class="MidHeading" style="width:100%"><img src="images/m_stats.gif" width="20" height="20" align="absMiddle">&nbsp;<?php echo GetLang('Bounce_Summary'); ?></div>
								<ul class="Text">
									<li><?php echo GetLang('Stats_TotalBounces'); ?><?php echo $tpl->Get('tabs','bounces','bounces_total'); ?></li>
									<li><?php echo GetLang('Stats_TotalSoftBounces'); ?><?php echo $tpl->Get('tabs','bounces','bounces_soft'); ?></li>
									<li><?php echo GetLang('Stats_TotalHardBounces'); ?><?php echo $tpl->Get('tabs','bounces','bounces_hard'); ?></li>
								</ul>
							</td>
							<td><?php echo $tpl->Get('tabs','bounces','bounce_chart'); ?></td>
						</tr>
					</table>

			        <div id="adminTabletriggeremails_bounces"></div>
				<?php endif; ?>
			</div>
		

		
			<div id="div5" style="display: <?php if($tpl->Get('PAGE','whichtab') == 5): ?>block<?php else: ?>none<?php endif; ?>; clear: both;">
				<div class="body" style="display: block; clear: both; padding-top:10px; padding-bottom:8px;"><?php echo $tpl->Get('tabs','unsubscribes','intro'); ?></div>

				<div style="padding-bottom: 10px;"><?php echo $tpl->Get('tabs','unsubscribes','calendar'); ?></div>

				<?php if(!$tpl->Get('record','processed_timeframe_unsubscribes')): ?>
					<div><?php echo $tpl->Get('tabs','unsubscribes','message'); ?></div>
				<?php else: ?>
					<table width="100%" border="0" class="Text">
						<tr>
							<td valign=top width="250" rowspan="2">
								<div class="MidHeading" style="width:100%"><img src="images/m_stats.gif" width="20" height="20" align="absMiddle">&nbsp;<?php echo GetLang('Unsubscribe_Summary'); ?></div>
								<ul class="Text">
									<li><?php echo GetLang('Stats_TotalUnsubscribes'); ?>:<?php echo $tpl->Get('tabs','unsubscribes','unsubscribes_total'); ?></li>
									<li><?php echo GetLang('Stats_MostUnsubscribes'); ?>:<?php echo $tpl->Get('tabs','unsubscribes','unsubscribes_most'); ?></li>
								</ul>
							</td>
							<td><?php echo $tpl->Get('tabs','unsubscribes','unsubscribe_chart'); ?></td>
						</tr>
					</table>

			        <div id="adminTabletriggeremails_unsubscribes"></div>
				<?php endif; ?>
			</div>
		

		
			<div id="div6" style="display: <?php if($tpl->Get('PAGE','whichtab') == 6): ?>block<?php else: ?>none<?php endif; ?>; clear: both;">
				<div class="body" style="display: block; clear: both; padding-top:10px; padding-bottom:8px;"><?php echo $tpl->Get('tabs','forwards','intro'); ?></div>

				<div style="padding-bottom: 10px;"><?php echo $tpl->Get('tabs','forwards','calendar'); ?></div>

				<?php if(!$tpl->Get('record','processed_timeframe_forwards')): ?>
					<div><?php echo $tpl->Get('tabs','forwards','message'); ?></div>
				<?php else: ?>
					<table width="100%" border="0" class="Text">
						<tr>
							<td valign=top width="250" rowspan="2">
								<div class="MidHeading" style="width:100%"><img src="images/m_stats.gif" width="20" height="20" align="absMiddle">&nbsp;<?php echo GetLang('Forwards_Summary'); ?></div>
								<ul class="Text">
									<li><?php echo GetLang('ListStatsTotalForwards'); ?><?php echo $tpl->Get('tabs','forwards','forward_total'); ?></li>
									<li><?php echo GetLang('ListStatsTotalForwardSignups'); ?><?php echo $tpl->Get('tabs','forwards','forward_signups'); ?></li>
								</ul>
							</td>
							<td><?php echo $tpl->Get('tabs','forwards','forwards_chart'); ?></td>
						</tr>
					</table>

			        <div id="adminTabletriggeremails_forwards"></div>
				<?php endif; ?>
			</div>
		

		
			<div id="div7" style="display: <?php if($tpl->Get('PAGE','whichtab') == 7): ?>block<?php else: ?>none<?php endif; ?>; clear: both;">
				<div class="body" style="display: block; clear: both; padding-top:10px; padding-bottom:8px;"><?php echo $tpl->Get('tabs','recipients','intro'); ?></div>

				<div style="padding-bottom: 10px;"><?php echo $tpl->Get('tabs','recipients','calendar'); ?></div>

				<?php if(!is_array($tpl->Get('tabs','recipients','records')) || count($tpl->Get('tabs','recipients','records')) == 0): ?>
					<div><?php echo $tpl->Get('tabs','recipients','message'); ?></div>
				<?php else: ?>
					<table width="100%" cellpadding="5" border="0" cellspacing="1" class="Text" style="padding-top: 0px; margin-top: 0px;">
						<tr>
							<td width="100%" colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td valign="top">&nbsp;</td>
										<td valign="top" align="right"><?php echo $tpl->Get('tabs','recipients','pagination_top'); ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class="Heading3">
							<td nowrap align="left"><?php echo GetLang('EmailAddress'); ?></td>
							<td nowrap align="left"><?php echo GetLang('SentWhen'); ?></td>
						</tr>
						<?php $array = $tpl->Get('tabs','recipients','records'); if(is_array($array) || is_object($array)): foreach($array as $__key=>$each): $tpl->Assign('__key', $__key, false); $tpl->Assign('each', $each, false);  ?>
							<tr>
								<td nowrap align="left"><?php echo $tpl->Get('each','note'); ?></td>
								<td nowrap align="left"><?php echo $tpl->Get('each','processed_senttime'); ?></td>
							</tr>
						 <?php endforeach; endif; ?>
						<tr>
							<td align="right" colspan="3"><?php echo $tpl->Get('tabs','recipients','pagination_bottom'); ?></td>
						</tr>
					</table>
				<?php endif; ?>
			</div>
		

		
			<div id="div8" style="display: <?php if($tpl->Get('PAGE','whichtab') == 8): ?>block<?php else: ?>none<?php endif; ?>; clear: both;">
				<div class="body" style="display: block; clear: both; padding-top:10px; padding-bottom:8px;"><?php echo $tpl->Get('tabs','failed','intro'); ?></div>

				<div style="padding-bottom: 10px;"><?php echo $tpl->Get('tabs','failed','calendar'); ?></div>

				<?php if(!is_array($tpl->Get('tabs','failed','records')) || count($tpl->Get('tabs','failed','records')) == 0): ?>
					<div><?php echo $tpl->Get('tabs','failed','message'); ?></div>
				<?php else: ?>
					<table width="100%" cellpadding="5" border="0" cellspacing="1" class="Text" style="padding-top: 0px; margin-top: 0px;">
						<tr>
							<td width="100%" colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td valign="top">&nbsp;</td>
										<td valign="top" align="right"><?php echo $tpl->Get('tabs','failed','pagination_top'); ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class="Heading3">
							<td nowrap align="left"><?php echo GetLang('EmailAddress'); ?></td>
							<td nowrap align="left"><?php echo GetLang('SentWhen'); ?></td>
						</tr>
						<?php $array = $tpl->Get('tabs','failed','records'); if(is_array($array) || is_object($array)): foreach($array as $__key=>$each): $tpl->Assign('__key', $__key, false); $tpl->Assign('each', $each, false);  ?>
							<tr>
								<td nowrap align="left"><?php echo $tpl->Get('each','note'); ?></td>
								<td nowrap align="left"><?php echo $tpl->Get('each','processed_senttime'); ?></td>
							</tr>
						 <?php endforeach; endif; ?>
						<tr>
							<td align="right" colspan="3"><?php echo $tpl->Get('tabs','failed','pagination_bottom'); ?></td>
						</tr>
					</table>
				<?php endif; ?>
			</div>
		
	
</div>